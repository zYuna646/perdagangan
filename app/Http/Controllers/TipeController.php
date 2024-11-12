<?php

namespace App\Http\Controllers;

use App\Models\Tipe;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.tipe.index', [
            'title' => 'Tipe',
            'subtitle' => '',
            'active' => 'tipe',
            'datas' => Tipe::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.tipe.create', [
            'title' => 'Tipe',
            'subtitle' => 'Add Tipe',
            'active' => 'tipe',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'tipe_name' => 'required|unique:tipes,name',
            ],
            [
                'tipe_name.required' => 'Tipe name is required!',
                'tipe_name.unique' => 'Tipe name already exists!',
            ]
        );

        Tipe::create([
            'name' => $request->tipe_name,
            'slug' => Str::slug($request->tipe_name),
        ]);

        return redirect()->route('admin.tipe')->with('success', 'Tipe has been added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.master-data.tipe.edit', [
            'title' => 'Tipe',
            'subtitle' => 'Edit Tipe',
            'active' => 'tipe',
            'data' => Tipe::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
            [
                'tipe_name' => 'required|unique:tipes,name,' . $id,
            ],
            [
                'tipe_name.required' => 'Tipe name is required!',
                'tipe_name.unique' => 'Tipe name already exists!',
            ]
        );

        $tipe = Tipe::findOrFail($id);

        $tipe->update([
            'name' => $request->tipe_name,
            'slug' => Str::slug($request->tipe_name),
        ]);

        return redirect()->route('admin.tipe')->with('success', 'Tipe has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tipe = Tipe::findOrFail($id);
        $tipe->delete();

        return redirect()->route('admin.tipe')->with('success', 'Tipe has been deleted!');
    }
}
