<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\StrawberryProduct;
use App\Models\Testimonial;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    /**
     * Generate and download a PDF summary report for admin usage.
     */
    public function downloadSummary(Request $request): Response
    {
        $generatedAt = now();
        $reportYear = (int) $request->query('year', $generatedAt->year);

        $userStats = [
            'total' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'members' => User::where('role', 'user')->count(),
            'new_this_month' => User::whereBetween('created_at', [$generatedAt->copy()->startOfMonth(), $generatedAt->copy()->endOfMonth()])->count(),
        ];

        $productStats = [
            'total' => StrawberryProduct::count(),
            'active' => StrawberryProduct::where('status', 'active')->count(),
            'inactive' => StrawberryProduct::where('status', 'inactive')->count(),
            'out_of_stock' => StrawberryProduct::where('status', 'out_of_stock')->count(),
            'organic' => StrawberryProduct::where('is_organic', true)->count(),
            'total_stock' => StrawberryProduct::sum('stock_quantity'),
        ];

        $recentUsers = User::latest()->take(10)->get(['name', 'email', 'role', 'created_at']);
        $productSnapshot = StrawberryProduct::orderBy('created_at', 'desc')->take(15)->get(['name', 'category', 'price', 'stock_quantity', 'status', 'origin']);

        $testimonialsStats = [
            'total' => Testimonial::count(),
            'approved' => Testimonial::where('is_approved', true)->count(),
            'pending' => Testimonial::where('is_approved', false)->count(),
        ];

        $activeContact = ContactInfo::where('is_active', true)->first();

        $months = collect(range(1, 12))->map(fn ($month) => Carbon::create($reportYear, $month, 1));
        $userTrend = $months->map(fn ($date) => [
            'label' => $date->translatedFormat('M Y'),
            'count' => User::whereBetween('created_at', [
                $date->copy()->startOfMonth(),
                $date->copy()->endOfMonth(),
            ])->count(),
        ]);

        $testimonialRatings = Testimonial::select('rating', DB::raw('count(*) as total'))
            ->groupBy('rating')
            ->orderBy('rating')
            ->pluck('total', 'rating')
            ->toArray();

        $ratingLabelsArray = [];
        $ratingDataArray = [];
        foreach (range(1, 5) as $rating) {
            $ratingLabelsArray[] = $rating . ' ⭐';
            $ratingDataArray[] = (int) ($testimonialRatings[$rating] ?? 0);
        }
        $ratingMax = max($ratingDataArray) ?: 1;

        $testimonialTrendRaw = $months->map(fn ($date) => [
            'label' => $date->translatedFormat('M Y'),
            'count' => Testimonial::whereBetween('created_at', [
                $date->copy()->startOfMonth(),
                $date->copy()->endOfMonth(),
            ])->count(),
        ]);

        $testimonialTrend = $testimonialTrendRaw;

        $userTrendCounts = $userTrend->pluck('count')->map(fn ($value) => (int) $value)->values()->all();
        $userAxisMax = max($userTrendCounts) ?: 0;

        $productStatusChart = $this->generateChartImage([
            'type' => 'doughnut',
            'data' => [
                'labels' => ['Aktif', 'Tidak Aktif', 'Habis Stok'],
                'datasets' => [[
                    'data' => [
                        (int) ($productStats['active'] ?? 0),
                        (int) ($productStats['inactive'] ?? 0),
                        (int) ($productStats['out_of_stock'] ?? 0),
                    ],
                    'backgroundColor' => ['#22c55e', '#6b7280', '#ef4444'],
                ]],
            ],
            'options' => [
                'plugins' => ['legend' => ['position' => 'bottom']],
            ],
        ]);

        $ratingChart = $this->generateChartImage([
            'type' => 'bar',
            'data' => [
                'labels' => $ratingLabelsArray,
                'datasets' => [[
                    'label' => 'Jumlah Testimoni',
                    'data' => $ratingDataArray,
                    'backgroundColor' => '#f97316',
                ]],
            ],
            'options' => [
                'plugins' => ['legend' => ['display' => false]],
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                        'ticks' => [
                            'stepSize' => 1,
                        ],
                    ],
                ],
            ],
        ]);

        $userTrendChart = $this->generateChartImage([
            'type' => 'line',
            'data' => [
                'labels' => $userTrend->pluck('label')->values()->all(),
                'datasets' => [[
                    'label' => 'Registrasi User',
                    'data' => $userTrendCounts,
                    'borderColor' => '#dc2626',
                    'backgroundColor' => 'rgba(220,38,38,0.15)',
                    'borderWidth' => 3,
                    'fill' => true,
                ]],
            ],
            'options' => [
                'plugins' => ['legend' => ['display' => false]],
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                        'ticks' => [
                            'stepSize' => 1,
                        ],
                    ],
                    'x' => [
                        'ticks' => [
                            'maxRotation' => 0,
                            'autoSkip' => true,
                        ],
                    ],
                ],
            ],
        ]);

        $testimonialTrendCounts = $testimonialTrend->pluck('count')->map(fn ($value) => (int) $value)->values()->all();
        $testimonialAxisMax = max($testimonialTrendCounts) ?: 0;

        $testimonialTrendChart = $this->generateChartImage([
            'type' => 'bar',
            'data' => [
                'labels' => $testimonialTrend->pluck('label')->values()->all(),
                'datasets' => [[
                    'label' => 'Testimoni Masuk',
                    'data' => $testimonialTrendCounts,
                    'backgroundColor' => '#10b981',
                ]],
            ],
            'options' => [
                'plugins' => ['legend' => ['display' => false]],
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                        'ticks' => [
                            'stepSize' => 1,
                        ],
                    ],
                ],
            ],
        ]);

        $pdf = Pdf::setOption(['isRemoteEnabled' => true])->loadView('admin.reports.summary', [
            'generatedAt' => $generatedAt,
            'userStats' => $userStats,
            'productStats' => $productStats,
            'recentUsers' => $recentUsers,
            'productSnapshot' => $productSnapshot,
            'testimonialsStats' => $testimonialsStats,
            'activeContact' => $activeContact,
            'reportYear' => $reportYear,
            'userTrend' => $userTrend,
            'testimonialTrend' => $testimonialTrend,
            'userTrendChart' => $userTrendChart,
            'testimonialTrendChart' => $testimonialTrendChart,
            'productStatusChart' => $productStatusChart,
            'ratingChart' => $ratingChart,
            'ratingLabels' => $ratingLabelsArray,
            'ratingData' => $ratingDataArray,
        ])->setPaper('a4', 'portrait');

        $fileName = 'laporan-ovaltin-' . $generatedAt->timestamp . '-' . uniqid() . '.pdf';

        return $pdf->stream($fileName);
    }

    protected function generateChartImage(array $config): ?string
    {
        $response = Http::get('https://quickchart.io/chart', [
            'width' => 700,
            'height' => 300,
            'format' => 'png',
            'c' => json_encode($config),
        ]);

        if ($response->successful()) {
            return base64_encode($response->body());
        }

        return null;
    }
}

