<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StrawberryProduct;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order
     */
    public function create()
    {
        $products = StrawberryProduct::where('status', 'active')
            ->where('stock_quantity', '>', 0)
            ->orderBy('name')
            ->get();

        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:1000',
            'delivery_date' => 'required|date|after:today',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:strawberry_products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:1000',
        ]);

        DB::beginTransaction();
        try {
            // Generate order number
            $orderNumber = Order::generateOrderNumber();

            // Calculate total amount
            $totalAmount = 0;
            $orderItems = [];

            foreach ($validated['products'] as $productData) {
                $product = StrawberryProduct::findOrFail($productData['product_id']);
                
                // Check stock availability
                if ($product->stock_quantity < $productData['quantity']) {
                    return back()->withErrors([
                        'products' => "Stok {$product->name} tidak mencukupi. Stok tersedia: {$product->stock_quantity}"
                    ])->withInput();
                }

                $quantity = (int) $productData['quantity'];
                $pricePerUnit = $product->price;
                $subtotal = $quantity * $pricePerUnit;

                $orderItems[] = [
                    'strawberry_product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $quantity,
                    'price_per_unit' => $pricePerUnit,
                    'subtotal' => $subtotal,
                ];

                $totalAmount += $subtotal;
            }

            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => $orderNumber,
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_address' => $validated['customer_address'],
                'order_date' => now(),
                'delivery_date' => $validated['delivery_date'],
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create order items
            foreach ($orderItems as $item) {
                $order->orderItems()->create($item);
            }

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Pemesanan berhasil dibuat! Nomor pesanan: ' . $orderNumber);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat membuat pesanan. Silakan coba lagi.'])
                ->withInput();
        }
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        // Check if user owns this order or is admin
        if ($order->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $order->load('orderItems.product');

        return view('orders.show', compact('order'));
    }
}
