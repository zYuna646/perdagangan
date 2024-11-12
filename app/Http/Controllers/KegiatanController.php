<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.kegiatan.index', [
            'title' => 'Kegiatan',
            'subtitle' => '',
            'active' => 'kegiatan',
            'datas' => Kegiatan::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.kegiatan.create', [
            'title' => 'Kegiatan',
            'subtitle' => 'Add Kegiatan',
            'active' => 'kegiatan',
        ]);
    }

    public function deleteImage($id, Request $request)
    {
        // Find the Kegiatan entry
        $kegiatan = Kegiatan::findOrFail($id);
        
        // Get the image to be deleted from the request
        $image = $request->query('image');

        // Check if the image exists in the foto_kegiatan field
        if ($kegiatan->foto_kegiatan && in_array($image, $kegiatan->foto_kegiatan)) {
            // Remove the image from storage
            Storage::disk('public')->delete($image);

            // Update the foto_kegiatan field by removing the image path
            $updatedImages = array_filter($kegiatan->foto_kegiatan, fn($img) => $img !== $image);
            $kegiatan->foto_kegiatan = $updatedImages;
            $kegiatan->save();
        }

        return redirect()->route('admin.kegiatan.edit', $id)->with('success', 'Image has been deleted successfully.');
    }

    public function show($id)
    {
        // Find the Kegiatan entry
        $kegiatan = Kegiatan::findOrFail($id);

        return view('admin.master-data.kegiatan.show', [
            'title' => 'Detail Kegiatan',
            'subtitle' => $kegiatan->nama_kegiatan,
            'active' => 'kegiatan',
            'data' => $kegiatan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'nama_kegiatan' => 'required|unique:kegiatans,nama_kegiatan',
                'tanggal_kegiatan' => 'required|date',
                'lokasi_kegiatan' => 'required|string',
                'foto_kegiatan.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for each image
            ],
            [
                'nama_kegiatan.required' => 'Nama kegiatan is required!',
                'tanggal_kegiatan.required' => 'Tanggal kegiatan is required!',
                'lokasi_kegiatan.required' => 'Lokasi kegiatan is required!',
                'foto_kegiatan.*.image' => 'Each file must be an image!',
            ]
        );

        // Handle file uploads and store paths in an array
        $fotoPaths = [];
        if ($request->hasFile('foto_kegiatan')) {
            foreach ($request->file('foto_kegiatan') as $file) {
                $fotoPaths[] = $file->store('kegiatan', 'public');
            }
        }

        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
            'foto_kegiatan' => $fotoPaths,
        ]);

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan has been added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.master-data.kegiatan.edit', [
            'title' => 'Kegiatan',
            'subtitle' => 'Edit Kegiatan',
            'active' => 'kegiatan',
            'data' => Kegiatan::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
            [
                'nama_kegiatan' => 'required|unique:kegiatans,nama_kegiatan,' . $id,
                'tanggal_kegiatan' => 'required|date',
                'lokasi_kegiatan' => 'required|string',
                'foto_kegiatan.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'nama_kegiatan.required' => 'Nama kegiatan is required!',
                'tanggal_kegiatan.required' => 'Tanggal kegiatan is required!',
                'lokasi_kegiatan.required' => 'Lokasi kegiatan is required!',
                'foto_kegiatan.*.image' => 'Each file must be an image!',
            ]
        );

        $kegiatan = Kegiatan::findOrFail($id);

        // Update existing fields
        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
        ]);

        // Handle file uploads if new files are provided
        if ($request->hasFile('foto_kegiatan')) {
            // Delete old images if they exist
            if (!empty($kegiatan->foto_kegiatan)) {
                foreach ($kegiatan->foto_kegiatan as $foto) {
                    Storage::disk('public')->delete($foto);
                }
            }

            // Store new image paths
            $fotoPaths = [];
            foreach ($request->file('foto_kegiatan') as $file) {
                $fotoPaths[] = $file->store('kegiatan', 'public');
            }

            // Update the photo field
            $kegiatan->foto_kegiatan = $fotoPaths;
            $kegiatan->save();
        }

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // Delete images associated with this record
        if (!empty($kegiatan->foto_kegiatan)) {
            foreach ($kegiatan->foto_kegiatan as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan')->with('success', 'Kegiatan has been deleted!');
    }
}
