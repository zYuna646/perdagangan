<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Category;
use App\Models\Tipe;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil data kategori dan tipe untuk dropdown filter
        $categories = Category::all();
        $tipes = Tipe::all();

        // Menerapkan filter jika ada
        $query = Alat::query();
        
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('tipe_id')) {
            $query->where('tipe_id', $request->tipe_id);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Mendapatkan data alat dengan filter
        $datas = $query->latest()->get();

        return view('admin.master-data.alat.index', [
            'title' => 'Alat',
            'subtitle' => '',
            'active' => 'alat',
            'datas' => $datas,
            'categories' => $categories,
            'tipes' => $tipes,
            'selectedCategory' => $request->category_id,
            'selectedTipe' => $request->tipe_id,
            'search' => $request->search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.alat.create', [
            'title' => 'Alat',
            'subtitle' => 'Add Alat',
            'active' => 'alat',
            'categories' => Category::all(),
            'tipes' => Tipe::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'tipe_id' => 'required|exists:tipes,id',
                'no_seri' => 'required|string|unique:alats,no_seri',
                'tanggal_tera' => 'required|date',
                'masa_berlaku_start' => 'required|date|before_or_equal:masa_berlaku_end',
                'masa_berlaku_end' => 'required|date|after_or_equal:masa_berlaku_start',
                'keterangan' => 'nullable|string',
            ],
            [
                'name.required' => 'Alat name is required!',
                'category_id.required' => 'Category is required!',
                'tipe_id.required' => 'Tipe is required!',
                'no_seri.required' => 'Serial number is required!',
                'tanggal_tera.required' => 'Tanggal tera is required!',
                'masa_berlaku_start.required' => 'Start date of validity is required!',
                'masa_berlaku_end.required' => 'End date of validity is required!',
            ]
        );

        Alat::create($request->all());

        return redirect()->route('admin.alat')->with('success', 'Alat has been added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.master-data.alat.edit', [
            'title' => 'Alat',
            'subtitle' => 'Edit Alat',
            'active' => 'alat',
            'data' => Alat::findOrFail($id),
            'categories' => Category::all(),
            'tipes' => Tipe::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'tipe_id' => 'required|exists:tipes,id',
                'no_seri' => 'required|string|unique:alats,no_seri,' . $id,
                'tanggal_tera' => 'required|date',
                'masa_berlaku_start' => 'required|date|before_or_equal:masa_berlaku_end',
                'masa_berlaku_end' => 'required|date|after_or_equal:masa_berlaku_start',
                'keterangan' => 'nullable|string',
            ]
        );

        $alat = Alat::findOrFail($id);
        $alat->update($request->all());

        return redirect()->route('admin.alat')->with('success', 'Alat has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('admin.alat')->with('success', 'Alat has been deleted!');
    }
}
