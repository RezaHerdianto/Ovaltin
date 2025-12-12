<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesData;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class SalesDataController extends Controller
{
    public function index(Request $request)
    {
        $forecastDays = $request->get('forecast_days', 30);
        $selectedProduct = $request->get('product', 'Agar');
        $modelType = $request->get('model_type', 'linear');
        
        // Ambil data penjualan untuk tabel
        $salesHistory = SalesData::orderBy('tanggal_penjualan', 'desc')->paginate(20);
        
        // Hitung summary untuk setiap produk
        $products = SalesData::getAvailableProducts();
        $summary = [];
        $chartData = [];
        $forecastResults = [];
        $forecastService = app(\App\Services\ForecastService::class);
        
        foreach ($products as $product) {
            // Ambil data historis
            $productSales = SalesData::where('nama_produk', $product)
                ->orderBy('tanggal_penjualan', 'asc')
                ->get();
            
            if ($productSales->count() >= 3) {
                // Lakukan forecasting
                $forecastResult = $forecastService->forecast($product, $productSales, $forecastDays, $modelType);
                
                if ($forecastResult) {
                    // Summary
                    $totalForecast = array_sum($forecastResult['forecast']['values']);
                    $avgForecast = $totalForecast / $forecastDays;
                    
                    $summary[$product] = [
                        'avg_forecast' => $avgForecast,
                        'total_forecast' => $totalForecast,
                    ];
                    
                    // Chart data
                    // Untuk Decision Tree, gunakan linear_regression sebagai predicted (karena struktur sama)
                    $predictedValues = $forecastResult['linear_regression']['values'] ?? $forecastResult['historical']['values'];
                    
                    $chartData[$product] = [
                        'historical' => [
                            'labels' => $forecastResult['historical']['dates'],
                            'actual' => $forecastResult['historical']['values'],
                            'predicted' => $predictedValues,
                        ],
                        'forecast' => [
                            'labels' => $forecastResult['forecast']['dates'],
                            'values' => $forecastResult['forecast']['values'],
                        ],
                        'metrics' => [
                            'r2' => $forecastResult['metrics']['R2 Score'],
                            'rmse' => $forecastResult['metrics']['RMSE'],
                            'mae' => $forecastResult['metrics']['MAE'],
                        ],
                        'model_type' => $modelType,
                    ];
                    
                    // Forecast results untuk tabel
                    $forecastResults[$product] = [
                        'success' => true,
                        'forecast' => array_map(function($date, $value) {
                            return [
                                'date' => $date,
                                'quantity' => $value,
                            ];
                        }, $forecastResult['forecast']['dates'], $forecastResult['forecast']['values']),
                    ];
                } else {
                    $forecastResults[$product] = ['success' => false];
                }
            } else {
                $forecastResults[$product] = ['success' => false];
            }
        }
        
        return view('sales-data.index', compact(
            'salesHistory', 
            'summary', 
            'forecastDays', 
            'selectedProduct', 
            'products',
            'chartData',
            'forecastResults',
            'modelType'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_penjualan' => 'required|date',
            'nama_produk' => 'required|string|in:' . implode(',', SalesData::getAvailableProducts()),
            'jumlah_terjual' => 'required|integer|min:0',
        ]);

        SalesData::create([
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'nama_produk' => $request->nama_produk,
            'jumlah_terjual' => $request->jumlah_terjual,
        ]);

        return redirect()->route('sales-data.index')->with('success', 'Data penjualan berhasil ditambahkan.');
    }

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            $file = $request->file('excel_file');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = $worksheet->toArray();

            if (count($rows) < 3) {
                return redirect()->route('sales-data.index')->with('error', 'File Excel kosong atau format tidak valid.');
            }

            // Struktur Excel: 
            // Baris 0: ["Tanggal ", "Produk", null, null, null, null, "Total", "Ket"]
            // Baris 1: [null, "agar", "dodol", "krupuk", "selai", "Sambel", null, null]
            // Baris 2+: Data penjualan
            
            // Cari header produk di baris kedua (index 1)
            $productHeaderRow = $rows[1] ?? [];
            $productColumns = [];
            
            // Cari kolom produk mulai dari kolom 1 (skip kolom 0 yang biasanya Tanggal)
            for ($col = 1; $col < count($productHeaderRow); $col++) {
                $headerValue = trim($productHeaderRow[$col] ?? '');
                if (!empty($headerValue)) {
                    // Normalisasi nama produk
                    $normalized = $this->normalizeProductName($headerValue);
                    if ($normalized) {
                        $productColumns[$col] = $normalized;
                    }
                }
            }

            if (empty($productColumns)) {
                return redirect()->route('sales-data.index')->with('error', 'Tidak ditemukan kolom produk di header.');
            }

            // Mulai dari baris ketiga (index 2) karena baris 0 dan 1 adalah header
            $importedCount = 0;
            $skippedCount = 0;
            $errors = [];

            DB::beginTransaction();

            try {
                for ($row = 2; $row < count($rows); $row++) {
                    $rowData = $rows[$row];
                    
                    // Kolom pertama adalah tanggal (index 0)
                    $tanggalValue = $rowData[0] ?? null;
                    
                    if (empty($tanggalValue)) {
                        continue;
                    }

                    // Coba ambil nilai langsung dari cell menggunakan koordinat Excel (A1, A2, dll)
                    // Column A = 1, row dimulai dari 1 (bukan 0)
                    $columnLetter = Coordinate::stringFromColumnIndex(1);
                    $cellCoordinate = $columnLetter . ($row + 1);
                    
                    try {
                        $cell = $worksheet->getCell($cellCoordinate);
                        $cellValue = $cell->getValue();
                        
                        // Jika cell adalah formula, ambil calculated value
                        if ($cell->getDataType() == DataType::TYPE_FORMULA) {
                            $cellValue = $cell->getCalculatedValue();
                        }
                        
                        // Jika cellValue kosong, gunakan nilai dari toArray()
                        if (empty($cellValue) && !empty($tanggalValue)) {
                            $cellValue = $tanggalValue;
                        }
                    } catch (\Exception $e) {
                        // Jika gagal, gunakan nilai dari toArray()
                        $cellValue = $tanggalValue;
                    }
                    
                    if (empty($cellValue)) {
                        continue;
                    }

                    // Parse tanggal
                    $tanggal = $this->parseDate($cellValue);
                    if (!$tanggal) {
                        $skippedCount++;
                        continue;
                    }

                    // Import data untuk setiap produk
                    foreach ($productColumns as $colIndex => $productName) {
                        $jumlahValue = $rowData[$colIndex] ?? null;
                        
                        if ($jumlahValue === null || $jumlahValue === '') {
                            continue;
                        }

                        // Konversi ke integer
                        $jumlah = $this->parseNumber($jumlahValue);
                        
                        if ($jumlah > 0) {
                            // Cek apakah data sudah ada (untuk menghindari duplikasi)
                            $exists = SalesData::where('tanggal_penjualan', $tanggal)
                                ->where('nama_produk', $productName)
                                ->exists();

                            if (!$exists) {
                                SalesData::create([
                                    'tanggal_penjualan' => $tanggal,
                                    'nama_produk' => $productName,
                                    'jumlah_terjual' => $jumlah,
                                ]);
                                $importedCount++;
                            }
                        }
                    }
                }

                DB::commit();

                $message = "Berhasil mengimpor {$importedCount} data penjualan.";
                if ($skippedCount > 0) {
                    $message .= " {$skippedCount} baris dilewati karena format tidak valid.";
                }

                return redirect()->route('sales-data.index')->with('success', $message);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('sales-data.index')->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
            }

        } catch (\Exception $e) {
            return redirect()->route('sales-data.index')->with('error', 'Gagal membaca file Excel: ' . $e->getMessage());
        }
    }

    /**
     * Normalisasi nama produk
     */
    private function normalizeProductName($name)
    {
        $name = strtolower(trim($name));
        $availableProducts = SalesData::getAvailableProducts();
        
        // Mapping nama produk
        $mapping = [
            'agar' => 'Agar',
            'dodol' => 'Dodol',
            'krupuk' => 'Krupuk',
            'selai' => 'Selai',
            'sambel' => 'Selai', // Sambel mungkin typo atau sama dengan selai
        ];

        if (isset($mapping[$name])) {
            return $mapping[$name];
        }

        // Cek apakah nama sudah sesuai dengan produk yang tersedia
        foreach ($availableProducts as $product) {
            if (strtolower($product) === $name) {
                return $product;
            }
        }

        return null;
    }

    /**
     * Parse tanggal dari berbagai format
     */
    private function parseDate($value)
    {
        if (empty($value)) {
            return null;
        }

        // Jika sudah berupa Carbon/DateTime object
        if ($value instanceof \DateTime) {
            return Carbon::instance($value)->format('Y-m-d');
        }

        // Jika berupa numeric (Excel date serial number) - HARUS dicek SEBELUM string
        if (is_numeric($value)) {
            try {
                // Gunakan PhpSpreadsheet untuk convert Excel date
                $dateTime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);
                return Carbon::instance($dateTime)->format('Y-m-d');
            } catch (\Exception $e) {
                // Jika gagal, coba sebagai timestamp Unix
                try {
                    return Carbon::createFromTimestamp($value)->format('Y-m-d');
                } catch (\Exception $e2) {
                    return null;
                }
            }
        }

        // Jika berupa string
        if (is_string($value)) {
            $value = trim($value);
            
            // Coba format dd/mm/yyyy (format Indonesia/Excel)
            if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $value, $matches)) {
                $day = (int)$matches[1];
                $month = (int)$matches[2];
                $year = (int)$matches[3];
                try {
                    return Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
                } catch (\Exception $e) {
                    return null;
                }
            }

            // Coba format yyyy-mm-dd
            if (preg_match('/^(\d{4})-(\d{1,2})-(\d{1,2})$/', $value, $matches)) {
                $year = (int)$matches[1];
                $month = (int)$matches[2];
                $day = (int)$matches[3];
                try {
                    return Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
                } catch (\Exception $e) {
                    return null;
                }
            }

            // Coba parse dengan Carbon (untuk format lain)
            try {
                $parsed = Carbon::parse($value);
                return $parsed->format('Y-m-d');
            } catch (\Exception $e) {
                return null;
            }
        }

        return null;
    }

    /**
     * Parse angka dari berbagai format
     */
    private function parseNumber($value)
    {
        if (is_numeric($value)) {
            return (int) $value;
        }

        if (is_string($value)) {
            // Hapus karakter non-numeric kecuali titik dan koma
            $cleaned = preg_replace('/[^0-9.,]/', '', $value);
            $cleaned = str_replace(',', '.', $cleaned);
            
            if (is_numeric($cleaned)) {
                return (int) floatval($cleaned);
            }
        }

        return 0;
    }

    public function getPrediction(Request $request)
    {
        $product = $request->get('product', 'Agar');
        $forecastDays = $request->get('forecast_days', 30);
        $modelType = $request->get('model_type', 'linear'); // 'linear' or 'decision_tree'

        // Ambil data historis dari database
        $salesData = SalesData::where('nama_produk', $product)
            ->orderBy('tanggal_penjualan', 'asc')
            ->get();

        if ($salesData->count() < 3) {
            return response()->json([
                'error' => 'Data historis terlalu sedikit untuk melakukan prediksi (minimal 3 data)',
            ], 400);
        }

        // Panggil service untuk melakukan forecasting
        try {
            $forecastService = app(\App\Services\ForecastService::class);
            $result = $forecastService->forecast($product, $salesData, $forecastDays, $modelType);

            if (!$result) {
                return response()->json([
                    'error' => 'Gagal melakukan prediksi. Pastikan data historis cukup (minimal 3 data).',
                ], 400);
            }

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        $salesData = SalesData::findOrFail($id);
        $salesData->delete();

        return redirect()->route('sales-data.index')->with('success', 'Data penjualan berhasil dihapus.');
    }
}
