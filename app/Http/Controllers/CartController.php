<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $cart = Cart::where('user_id', Auth::user()->id)->first();

            if ($cart == null) {
                $cart = Cart::create([
                    'user_id' => Auth::user()->id,
                    'total' => 0
                ]);
            }

            $cartItems = CartItem::with(['product', 'product.category', 'product.inventory', 'cart'])->where('cart_id', $cart->id)->get();

            return ResponseFormatter::success(
                [
                    'cartItems' => $cartItems
                ],
                "Berhasil mendapatkan cart"
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Terjadi Kesalahan Pada Server',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_id' => ['required']
        ]);

        try {

            $cart = Cart::where('user_id', Auth::user()->id)->first();
            $cartItem = CartItem::where('product_id', $request->product_id)->first();

            if ($cart == null) {
                $cart = Cart::create([
                    'user_id' => Auth::user()->id,
                    'total' => 0
                ]);
            }

            if ($cartItem == null) {
                CartItem::create([
                    'product_id' => $request->product_id,
                    'quantity' => 1,
                    'cart_id' => $cart->id
                ]);
            } else {
                $cartItem->update([
                    'quantity' => $cartItem->quantity + 1
                ]);
            }

            $product = Product::find($request->product_id);

            $cart->update([
                'total' => $cart->total + $product->price
            ]);

            return ResponseFormatter::success("Berhasil menambahkan produk ke keranjang");
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Terjadi Kesalahan Pada Server',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $cartItem = CartItem::with(['cart'])->find($id);

            $cartItem->cart->update([
                'total' => $cartItem->cart->total - ($cartItem->product->price * $cartItem->quantity)
            ]);

            CartItem::destroy($id);

            return ResponseFormatter::success(
                "Berhasil menghapus produk dari keranjang"
            );
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Terjadi Kesalahan Pada Server',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function addQuantity($id)
    {
        try {

            $cartItem = CartItem::with(['product', 'cart'])->find($id);
            $cartItem->quantity = $cartItem->quantity + 1;
            $cartItem->cart->total = $cartItem->cart->total + $cartItem->product->price;

            $cartItem->save();
            $cartItem->cart->save();
            
            return ResponseFormatter::success(
                $cartItem,
                "Quantity Ditambah"
            ); 
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Terjadi Kesalahan Pada Server',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }

    public function removeQuantity($id)
    {
        try {

            $cartItem = CartItem::with(['product', 'cart'])->find($id);
            $cartItem->quantity = $cartItem->quantity - 1;
            $cartItem->cart->total = $cartItem->cart->total - $cartItem->product->price;

            $cartItem->save();
            $cartItem->cart->save();
            
            return ResponseFormatter::success(
                $cartItem,
                "Quantity dikurangi"
            ); 
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Terjadi Kesalahan Pada Server',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
    }
}
