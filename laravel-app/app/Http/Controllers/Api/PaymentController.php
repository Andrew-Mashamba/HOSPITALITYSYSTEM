<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Services\Payment\PaymentService;
use App\Jobs\ProcessPayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Process a payment
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,card,mobile_money',
            'phone_number' => 'required_if:payment_method,mobile_money',
            'provider' => 'required_if:payment_method,mobile_money|in:mpesa,tigopesa,airtel',
            'card_last_four' => 'required_if:payment_method,card',
            'card_type' => 'required_if:payment_method,card',
            'tendered' => 'required_if:payment_method,cash|numeric',
        ]);

        $order = Order::findOrFail($validated['order_id']);

        $payment = $this->paymentService->processPayment($order, $validated);

        if (in_array($validated['payment_method'], ['mobile_money', 'card'])) {
            ProcessPayment::dispatch($payment);
        }

        return response()->json([
            'message' => 'Payment processed successfully',
            'payment' => $payment,
        ], 201);
    }

    /**
     * Get payment details
     */
    public function show($id)
    {
        $payment = Payment::with('order')->findOrFail($id);

        return response()->json($payment);
    }

    /**
     * Confirm a payment
     */
    public function confirm($id)
    {
        $payment = Payment::findOrFail($id);

        $this->paymentService->confirmPayment($payment);

        return response()->json([
            'message' => 'Payment confirmed successfully',
            'payment' => $payment->fresh(),
        ]);
    }

    /**
     * Get bill for an order
     */
    public function getBill($orderId)
    {
        $order = Order::findOrFail($orderId);

        $bill = $this->paymentService->generateBill($order);

        return response()->json($bill);
    }
}
