<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function product()
    {
        if(Auth::id()){
            if(Auth::user()->usertype == '1'){
                return view('admin.product');
            }
            else{
                return redirect()->back();
            }
        }else{
            return redirect('login');
        }
    }

    public function uploadproduct(Request $request)
    {

        $products = new Product;

        $image = $request->file;

        $imagename = time() . '.' . $image->getClientOriginalExtension();

        $request->file->move('productimage', $imagename);

        $products->image = $imagename;

        $products->title = $request->title;

        $products->price = $request->price;

        $products->description = $request->description;

        $products->quantity = $request->quantity;

        $products->save();

        return redirect()->back()->with('message', 'Product added successfully.');
    }

    public function showproduct()
    {

        $products = Product::all();

        return view('admin.showproduct', compact('products'));
    }


    public function deleteproduct($id)
    {

        $product = Product::find($id);
        @unlink(public_path($product->image));
        $product->delete();

        return redirect()->back()->with('message', 'Product deleted successfully.');
    }

    public function updateproduct($id)
    {

        $product = Product::find($id);

        return view('admin.updateproduct', compact('product'));
    }

    public function editproduct(Request $request, $id)
    {

        $products = Product::find($id);

        $image = $request->file;

        if($image){

        $imagename = time() . '.' . $image->getClientOriginalExtension();

        $request->file->move('productimage', $imagename);

        $products->image = $imagename;

        }

        $products->title = $request->title;

        $products->price = $request->price;

        $products->description = $request->description;

        $products->quantity = $request->quantity;

        $products->save();

        return redirect()->back()->with('message', 'Product updated successfully.');
    }
}
