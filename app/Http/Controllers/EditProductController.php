<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EditProductController extends Controller
{
    public function  showEditProduct($id)
    {
        $product = Product::findOrFail($id);
        
        return view('EditProduct', ['product' => $product]);
    }

    public function getImages($product_id)
    {
        $images = Image::where('product_id', $product_id)->get();
    
        return response()->json(['images' => $images]);
    }

    public function update(Request $request, Product $product)
    {
        try {
            $product->update([
                'name' => $request->input('name'),
                'category' => $request->input('category'),
                'description' => $request->input('description'),
                'date_time' => $request->input('date_time'),
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $imageFile) {
                    $imagePath = $imageFile->store('product_images');
                    $product->images()->create([
                        'path' => $imagePath,

                    ]);
                }
            }
        
            $successMessage = 'Product updated successfully';
            session()->flash('success', $successMessage);

            return response()->json(['message' => $successMessage,'redirectTo' => route('dashboard'), ]);
        } catch (\Exception $e) {
            logger()->error('Product update error: ' . $e->getMessage());
            return response()->json(['error' => 'Product update failed'], 500);
        }
    }

}
