<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index(Request $request) {

        $query = Product::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('in_stock')) {
            $query->where('in_stock', '>', 0);
        }

        $products = $query->paginate(10);
        $totalInStock = Product::where('in_stock', '>', 0)->sum('in_stock');

        return response()->json([
            'products' => $products,
            'total_in_stock_value' => $totalInStock,
        ]);
    }

    public function create(Request $request) {

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'category' => 'required|string',
                'in_stock' => 'integer'
            ]);

            $product = Product::create($validated);
            return response()->json($product, 201);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Ошибка валидации',
                'errors' => $e->errors(),
            ], 404);
        }
    }

    public function update(Request $request, Product $product) {

        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'price' => 'sometimes|required|numeric',
                'category' => 'sometimes|required|string',
                'in_stock' => 'integer'
            ]);

            $product->update($validated);
            return response()->json($product);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Ошибка валидации',
                'errors' => $e->errors(),
            ], 404);
        }
    }

    public function delete(Product $product) {

        $product->delete();
        return response()->json(['message' => 'Product deleted']);
    }
}
