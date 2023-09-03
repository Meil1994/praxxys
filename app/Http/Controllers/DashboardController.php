<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function  showDashboard()
    {
        return view('Dashboard');
    }

    public function index(Request $request)
    {
       return Product::where('id', '!=', Null)->paginate(10);
    }

    public function indexSearch(Request $request)
    {
        $query = Product::query();
        
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                  ->orWhere('description', 'LIKE', "%$search%");
            });
        }

        if ($request->has('category')) {
            $category = $request->input('category');
            if ($category !== '') {
                $query->where('category', $category);
            }
        }

        return $query->paginate(10);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        $successMessage = 'Product deleted successfully';
        session()->flash('success', $successMessage);

        return response()->json(['message' => $successMessage]);
    }


}
