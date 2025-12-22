<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // All orders list dikhana
    public function index()
    {
        $orders = Order::with(['customer', 'creator'])->get();
        return view('staff.orders.index', compact('orders'));
    }

    // Order details dikhana
    public function show($id)
    {
        $order = Order::with(['customer', 'orderItems.product'])->findOrFail($id);
        return view('staff.orders.show', compact('order'));
    }

    // Order status update karna
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,In-Process,Completed,Delivered',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->route('orders.show', $id)
            ->with('success', 'Order status updated successfully!');
    }

    // Customer ke liye order create karna
    public function store(Request $request)
    {
        $request->validate([
            'deliveryAddress' => 'required|string',
            'cart' => 'required|string',
        ]);

        // Parse cart JSON
        $cartItems = json_decode($request->cart, true);
        
        if (empty($cartItems)) {
            return back()->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();
        try {
            $customer = auth('customer')->user();
            
            // Order create karna
            $order = Order::create([
                'customerId' => $customer->id,
                'userId' => null,
                'customerName' => $customer->name,
                'customerEmail' => $customer->email,
                'customerPhone' => $customer->phone,
                'totalAmount' => 0,
                'status' => 'Pending',
                'deliveryAddress' => $request->deliveryAddress,
            ]);

            $totalAmount = 0;

            // Order items create karna
            foreach ($cartItems as $item) {
                $product = Product::findOrFail($item['productId']);
                
                // Check stock availability
                if ($product->stockQuantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }
                
                $subtotal = $product->price * $item['quantity'];
                $totalAmount += $subtotal;

                OrderItem::create([
                    'orderId' => $order->id,
                    'productId' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);

                // Stock reduce karna
                $product->decrement('stockQuantity', $item['quantity']);
            }

            // Total amount update karna
            $order->update(['totalAmount' => $totalAmount]);

            DB::commit();
            
            // Redirect to order success page with order details
            return redirect()->route('customer.order.success', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }

    // Order success page dikhana
    public function orderSuccess($id)
    {
        $order = Order::with(['customer', 'orderItems.product'])
            ->where('customerId', auth('customer')->id())
            ->findOrFail($id);
        
        return view('customer.order-success', compact('order'));
    }
}
