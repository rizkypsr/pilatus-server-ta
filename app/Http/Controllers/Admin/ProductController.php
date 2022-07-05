<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use Bepsvpt\Blurhash\BlurHash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate();

        return Inertia::render('Admin/Product/Index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return Inertia::render('Admin/Product/Create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|mimes:png,jpg, jpeg|max:2048',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error([
                'message' => 'Terjadi Kesalahan Pada Server',
                'error' => $validator->errors(),
            ], 'Authentication Failed', 422);
        }

        if ($photo = $request->file('photo')) {
            $photo->storeAs('public/products', $photo->hashName());

            $blurHash = new BlurHash();

            $inventory = Inventory::create([
                'quantity' => (int) $request->stock
            ]);

            $product = Product::create([
                'name' => $request->name,
                'desc' => $request->description,
                'category_id' => (int) $request->category,
                'inventory_id' => $inventory->id,
                'price' => (int) $request->price,
                'weight' => floatval($request->weight),
                'photo' => $photo->hashName(),
                'blurhash' => $blurHash->encode($photo),
            ]);

            return redirect()->route('products.index')
                ->with('message', 'Produk berhasil ditambahkan');;
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Inertia::render('Admin/Product/Edit');
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
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('message', 'Produk berhasil dihapus');
    }
}
