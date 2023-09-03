<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Product;
use Illuminate\Http\Request;

class CreateProductController extends Controller
{
    public function showCreate()
    {
        return view('Create');
    }

    public function create(Request $request)
    {
        logger()->info('Data received from the request: ' . json_encode($request->all()));
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'nullable|date',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'date_time' => $request->input('date_time'),
        ]);

        $product->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('product_images', 'public');
                $product->images()->create(['path' => $imagePath]);
            }
        }

        $successMessage = 'Product created successfully';
        session()->flash('success', $successMessage);

        return response()->json(['message' => $successMessage,'redirectTo' => route('dashboard'), ]);
    }
}
