<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Variabel Request
        $id = $request->input('id');
        $product_id = $request->input('product_id');
        $name = $request->input('name');
        $limit = $request->input('limit');

        // Category Detail
        if ($id) {
            $category = ProductCategory::with(['products'])->find($id);

            if ($category) {
                return ResponseFormatter::success(
                    $category,
                    'Data Category Success'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data Category Empty',
                    404
                );
            }
        }

        $category = ProductCategory::query();

        if ($name) {
            $category->where('name', 'like', '%' . $name . '%')->with('products');
        }
        if ($product_id) {
            $category = $category->whereHas('products', function ($query_products) use ($product_id) {
                $query_products->where('id', $product_id);
            })->with(['products' => function ($query) use ($product_id) {
                $query->where('id', $product_id);
            }])->get();

            return ResponseFormatter::success(
                $category,
                'Data Category Success'
            );
        }

        return ResponseFormatter::success(
            $category->paginate($limit),
            'Data Category Success'
        );
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
        //
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
