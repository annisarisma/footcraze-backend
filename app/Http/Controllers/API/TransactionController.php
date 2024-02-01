<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Define Variable Input
        $id = $request->input('id');
        $limit = $request->input('limit',6);
        $status = $request->input('status');

        // Condition ID Inputed
        if ($id) {
            $transaction = Transaction::with(['items.product'])->find($id);
            
            // Condition Transaction Exist
            if ($transaction) {
                // Return JSON
                return ResponseFormatter::success([
                    'transaction' => $transaction
                ], 'Transaction Data Successfully');
            } else {
                // Return JSON
                return ResponseFormatter::error(
                    'Transaction Data Empty', 400
                );
            }
        }

        // Query Data
        $transaction = Transaction::with(['items.product'])->where('users_id', Auth::user()->id);

        // Condition Status Inputed
        if ($status) {
            $transaction->where('status', $status);
        }

        // Return JSON
        return ResponseFormatter::success([
            'transaction' => $transaction->paginate($limit)
        ], 'Transaction Successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Request Validate
        $request->validate([
            'items' => ['required', 'array'],
            'items.*.id' => ['exists:products,id'],
            'total_price' => ['required'],
            'shipping_price' => ['required'],
            'status' => ['required', 'in:PENDING']
        ]);

        // Store Data Transaction
        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'address' => $request->address,
            'total_price' => $request->total_price,
            'shipping_price' => $request->shipping_price,
            'status' => $request->status
        ]);

        // Store Data Transaction Item
        foreach ($request->items as $product) {
            TransactionItem::create([
                'user_id' => Auth::user()->id,
                'transaction_id' => $transaction->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity']
            ]);
        }

        // Return JSON
        return ResponseFormatter::success([
            'transaction' => $transaction->load('items.product')
        ], 'Checkout Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
