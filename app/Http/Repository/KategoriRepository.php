<?php

namespace App\Http\Repository;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriRepository
{
    protected $kategori;

    public function __construct(Kategori $kategori)
    {
        $this->kategori = $kategori;
    }

    public function all()
    {
        return $this->kategori::orderBy('id_kategori', 'desc')->get();
    }

    public function find($id)
    {
        return $this->kategori->find($id);
    }

    public function store(array $validated)
    {
        $kategori = new $this->kategori;
        $kategori->nama_kategori = $validated['nama_kategori'];
        $kategori->save();

        return $kategori;
    }

    public function update($validated, $id)
    {

        $kategori = $this->kategori->find($id);
        $kategori->nama_kategori = $validated['nama_kategori'];
        $kategori->update();

        return $kategori;
    }

    public function delete($id)
    {
        $kategori = $this->kategori->find($id);
        $kategori->delete();
    }
}