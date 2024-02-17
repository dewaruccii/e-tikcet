<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maskapai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class MaskapaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maskapai = Maskapai::get();
        return view('admin.maskapai.index', compact('maskapai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = User::get();
        return view('admin.maskapai.create', compact('user'));
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
            'logo' => 'required',
            'owner' => 'required',
        ]);
        $maskapai = new Maskapai();
        $maskapai->name = $request->name;
        $maskapai->description = $request->description;
        $maskapai->uuid = Uuid::fromDateTime(now());
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $path = '/maskapai/' . md5($request->name) . '/logo/' . Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put($path, file_get_contents($file));
            $maskapai->logo = $path;
        }
        $maskapai->owner_id = $request->owner;
        $maskapai->save();
        return redirect()->route('admin.maskapai.index')->with('success', 'Maskapai has been created');
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
        $user = User::get();
        $maskapai = Maskapai::where('uuid', $id)->first();
        return view('admin.maskapai.edit', compact('user', 'maskapai'));
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
        $request->validate([
            'name' => 'required|sometimes',
            'description' => 'required|sometimes',
            'logo' => 'required|sometimes',
            'owner' => 'required|sometimes',
        ]);
        $maskapai = Maskapai::where('uuid', $id)->first();
        $maskapai->name = $request->name;
        $maskapai->description = $request->description;
        $maskapai->uuid = Uuid::fromDateTime(now());
        if ($request->hasFile('logo')) {
            Storage::delete('/public/' . $maskapai->logo);
            $file = $request->file('logo');
            $path = '/maskapai/' . md5($request->name) . '/logo/' . Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('public/' . $path, file_get_contents($file));
            $maskapai->logo = $path;
        }
        $maskapai->owner_id = $request->owner;
        $maskapai->save();
        return redirect()->route('admin.maskapai.index')->with('success', 'Maskapai has been created');
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
