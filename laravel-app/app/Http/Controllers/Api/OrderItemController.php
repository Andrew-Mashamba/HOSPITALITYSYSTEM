<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Services\OrderManagement\OrderDistributionService;
use App\Events\OrderItemReady;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    protected OrderDistributionService $distributionService;

    public function __construct(OrderDistributionService $distributionService)
    {
        $this->distributionService = $distributionService;
    }

    /**
     * Mark item as received by kitchen/bar staff
     */
    public function markReceived(Request $request, $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $staff = $request->user();

        $this->distributionService->markItemReceived($orderItem, $staff);

        return response()->json([
            'message' => 'Order item marked as received',
            'item' => $orderItem->fresh(),
        ]);
    }

    /**
     * Mark item as done/ready
     */
    public function markDone($id)
    {
        $orderItem = OrderItem::with('order')->findOrFail($id);

        $this->distributionService->markItemReady($orderItem);

        event(new OrderItemReady($orderItem));

        return response()->json([
            'message' => 'Order item marked as ready',
            'item' => $orderItem->fresh(),
        ]);
    }

    /**
     * Get pending items for current staff
     */
    public function pending(Request $request)
    {
        $staff = $request->user();

        if (!in_array($staff->role, ['chef', 'bartender'])) {
            return response()->json([
                'message' => 'Only chefs and bartenders can view pending items',
            ], 403);
        }

        $prepArea = $staff->role === 'chef' ? 'kitchen' : 'bar';

        $items = $this->distributionService->getPendingItems($prepArea);

        return response()->json([
            'items' => $items,
            'total' => $items->count(),
        ]);
    }
}
