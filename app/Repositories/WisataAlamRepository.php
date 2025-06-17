<?php

namespace App\Repositories;

use App\Models\WisataAlam;
use App\Repositories\Interfaces\WisataAlamRepositoryInterface;

class WisataAlamRepository implements WisataAlamRepositoryInterface
{
    public function all()
    {
        return WisataAlam::all();
    }

    public function find($id)
    {
        return WisataAlam::findOrFail($id);
    }

    public function create(array $data)
    {
        return WisataAlam::create($data);
    }

    public function update($id, array $data)
    {
        $wisata = WisataAlam::findOrFail($id);
        $wisata->update($data);
        return $wisata;
    }

    public function delete($id)
    {
        $wisata = WisataAlam::findOrFail($id);
        return $wisata->delete();
    }
}
