<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\WisataAlamRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class WisataAlamController extends Controller
{
    protected $wisataAlamRepo;

    public function __construct(WisataAlamRepositoryInterface $wisataAlamRepo)
    {
        $this->wisataAlamRepo = $wisataAlamRepo;
    }

    public function index()
    {
        $wisataList = $this->wisataAlamRepo->all();

        // Tambahkan gambar_url ke setiap data
        $wisataList->each(function ($item) {
            $item->gambar_url = $item->gambar ? asset('storage/wisata/' . $item->gambar) : null;
        });

        return response()->json($wisataList);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'jam_buka' => 'nullable',
            'jam_tutup' => 'nullable',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'harga_tiket' => 'nullable|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        if ($request->hasFile('gambar')) {
            $filename = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/wisata', $filename);
            $data['gambar'] = $filename;
        }

        $wisata = $this->wisataAlamRepo->create($data);
        $wisata->gambar_url = $wisata->gambar ? asset('storage/wisata/' . $wisata->gambar) : null;

        return response()->json($wisata, 201);
    }

    public function show($id)
    {
        $wisata = $this->wisataAlamRepo->find($id);
        $wisata->gambar_url = $wisata->gambar ? asset('storage/wisata/' . $wisata->gambar) : null;

        return response()->json($wisata);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_wisata' => 'sometimes|required|string|max:255',
            'alamat' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'jam_buka' => 'nullable',
            'jam_tutup' => 'nullable',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'harga_tiket' => 'nullable|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        // Ambil data lama untuk hapus gambar jika perlu
        $oldData = $this->wisataAlamRepo->find($id);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($oldData->gambar && Storage::exists('public/wisata/' . $oldData->gambar)) {
                Storage::delete('public/wisata/' . $oldData->gambar);
            }

            $filename = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->storeAs('public/wisata', $filename);
            $data['gambar'] = $filename;
        }

        $wisata = $this->wisataAlamRepo->update($id, $data);
        $wisata->gambar_url = $wisata->gambar ? asset('storage/wisata/' . $wisata->gambar) : null;

        return response()->json($wisata);
    }

    public function destroy($id)
    {
        $wisata = $this->wisataAlamRepo->find($id);

        // Hapus gambar jika ada
        if ($wisata->gambar && Storage::exists('public/wisata/' . $wisata->gambar)) {
            Storage::delete('public/wisata/' . $wisata->gambar);
        }

        $this->wisataAlamRepo->delete($id);

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
