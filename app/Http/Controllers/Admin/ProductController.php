<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::where('maskapai_id', Auth::user()->Maskapai?->id)->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'is_active' => 'required',
            'from_airport' => 'required',
            'destination_airport' => 'required',
            'estimated_fly' => 'required',
            'estimated_fly_hour' => 'required',
            'estimated_arrival' => 'required',
            'estimated_arrival_hour' => 'required',
        ]);
        try {
            DB::beginTransaction();
            $product = new Product();
            $product->name = $request->name;
            $product->uuid = Uuid::fromDateTime(now());
            $product->maskapai_id = Auth::user()->Maskapai?->id;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->is_active = $request->is_active;
            $product->save();

            $detail = new ProductDetail();
            $detail->product_id = $product->id;
            $detail->from_airport = $request->from_airport;
            $detail->destination_airport = $request->destination_airport;
            $detail->estimated_fly = $request->estimated_fly . ' ' . $request->estimated_fly_hour . ':00';
            $detail->estimated_arrival = $request->estimated_arrival . ' ' . $request->estimated_arrival_hour . ':00';
            $detail->save();
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Product has been successfully created.');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e);
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
        //
    }
}
