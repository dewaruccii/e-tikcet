<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class BillingController extends Controller
{
    //
    public function index($uuid)
    {
        $product = Product::where('uuid', $uuid)->first();
        if (!$product) {
            return redirect('/')->with('failed', 'Something went wrong on chosen product');
        }
        $billing = new Billing();
        $billing->uuid = Uuid::fromDateTime(now());
        $billing->product_id = $product->id;
        $billing->user_id = Auth::user()->id;
        $billing->status_id = 0;
        $billing->save();
        return redirect()->route('billings.information', $billing->uuid);
    }
    public function information($uuid)
    {
        $billing = Billing::where('uuid', $uuid)->first();
        if (!$billing) {
            return redirect('/')->with('failed', 'Something went wrong');
        }
        return view('billings.index', compact('billing'));
    }
}
