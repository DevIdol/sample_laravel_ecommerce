<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::User()->usertype;

        if ($usertype == '1') {
            return view('admin.home');
        } else {
            $products = Product::paginate(3);
            $user = auth()->user();
            $count = Cart::where('phone', $user->phone)->count();
            return view('user.home', compact('products', 'count'));
        }
    }

    public function index()
    {

        if (Auth::id()) {
            return redirect('redirect');
        } else {

            $products = Product::paginate(3);

            return view('user.home', compact('products'));
        }
    }

    public function search(Request $request)
    {

        $search = $request->search;
        if ($search == '') {
            $products = Product::paginate(3);
            return view('user.home', compact('products'));
        }

        $products = Product::where('title', 'Like', '%' . $search . '%')->get();

        return view('user.home', compact('products'));
    }

    public function addcart(Request $request, $id)
    {

        if (Auth::id()) {

            $user = auth()->user();

            $products = Product::find($id);

            $cart = new Cart;

            $cart->name = $user->name;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->product_title = $products->title;
            $cart->price = $products->price;
            $cart->quantity = $request->quantity;

            $cart->save();

            return redirect()->back()->with('message', 'Product updated successfully.');
        } else {
            return redirect('login');
        }
    }

    public function showcart()
    {

        $user = auth()->user();
        $carts = Cart::where('phone', $user->phone)->get();

        $count = Cart::where('phone', $user->phone)->count();

        return view('user.showcart', compact('carts', 'count'));
    }

    public function deletecart($id)
    {
        $carts = Cart::find($id);
        $carts->delete();

        return redirect()->back()->with('message', 'Product deleted successfully.');
    }

    public function confirmorder(Request $request)
    {

        $user = auth()->user();

        $name = $user->name;

        $phone = $user->phone;

        $address = $user->address;

        foreach ($request->productname as $key => $productname) {
            $order = new Order;

            $order->product_name = $request->productname[$key];
            $order->price = $request->price[$key];
            $order->quantity = $request->quantity[$key];

            $order->name = $name;
            $order->phone = $phone;
            $order->address = $address;

            $order->status= 'not delivered';

            $order->save();
        }
        DB::table('carts')->where('phone', $phone)->delete();
        return redirect()->back()->with('message', 'Product ordered successfully.');
    }
}
