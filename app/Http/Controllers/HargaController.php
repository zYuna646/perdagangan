<?php

namespace App\Http\Controllers;

use App\Models\Harga;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.harga.index', [
            'title' => 'Harga',
            'subtitle' => '',
            'active' => 'harga',
            'datas' => Harga::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.harga.create', [
            'title' => 'Harga',
            'subtitle' => 'Add Harga',
            'active' => 'harga',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'nama' => 'required|unique:hargas,nama',
                'file_harga' => 'required|file', // Ensures a file is uploaded
            ],
            [
                'nama.required' => 'Nama is required!',
                'nama.unique' => 'Nama already exists!',
                'file_harga.required' => 'File harga is required!',
                'file_harga.file' => 'File harga must be a valid file!',
            ]
        );

        // Handle file upload
        $filePath = $request->file('file_harga')->store('hargas');

        Harga::create([
            'nama' => $request->nama,
            'file_harga' => $filePath,
        ]);

        return redirect()->route('admin.harga')->with('success', 'Harga has been added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.master-data.harga.edit', [
            'title' => 'Harga',
            'subtitle' => 'Edit Harga',
            'active' => 'harga',
            'data' => Harga::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
            [
                'nama' => 'required|unique:hargas,nama,' . $id,
                'file_harga' => 'nullable|file', // Allows optional file upload
            ],
            [
                'nama.required' => 'Nama is required!',
                'nama.unique' => 'Nama already exists!',
                'file_harga.file' => 'File harga must be a valid file!',
            ]
        );

        $harga = Harga::findOrFail($id);

        // Handle file upload if a new file is provided
        if ($request->hasFile('file_harga')) {
            $filePath = $request->file('file_harga')->store('hargas');
            $harga->file_harga = $filePath;
        }

        $harga->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.harga')->with('success', 'Harga has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $harga = Harga::findOrFail($id);
        $harga->delete();

        return redirect()->route('admin.harga')->with('success', 'Harga has been deleted!');
    }
}
