<?php

namespace App\Http\Repository;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukRepository
{
    protected $produk;
    protected $kategori;

    public function __construct(Produk $produk, Kategori $kategori)
    {
        $this->produk = $produk;
        $this->kategori = $kategori;
    }

    public function index()
    {
        return $this->kategori->all()->pluck('nama_kategori', 'id_kategori');
    }

    public function all()
    {
        return $this->produk::leftJoin('kategori', 'kategori.id_kategori', 'produk.id_kategori')
        ->select('produk.*', 'nama_kategori')
        ->orderBy('kode_produk', 'asc')
        ->get();
    }
    
    public function latest()
    {
        return $this->produk::latest()->first();
    }

    public function find($id)
    {
        return $this->produk->find($id);
    }

    public function store(array $validated)
    {
        return $produk = $this->produk::create($validated);
    }
    
    public function create(array $data)
    {
        return $this->produk->create($data);
    }

    public function findById($id, $request)
    {
        $produk = $this->produk->where('id_produk', $id)->first();

        return $produk->fresh();
    }

    public function update($data, $id)
    {

        $produk = $this->produk->find($data, $id);
        $produk->nama_produk = $data['nama_produk'];
        $produk->id_kategori = $data['id_kategori'];
        $produk->merk = $data['merk'];
        $produk->harga_beli = $data['harga_beli'];
        $produk->harga_jual = $data['harga_jual'];
        $produk->diskon = $data['diskon'];
        $produk->stok = $data['stok'];
        $produk->update();

        return $produk;
    }

    public function delete($id)
    {
        $produk = $this->produk->find($id);
        $produk->delete();
    }

    public function deleteSelected($request)
    {
        foreach ($request->id_produk as $id) {
            $produk = $this->produk::find($id);
            $produk->delete();
        }
    }

    public function cetakBarcode($request)
    {
        foreach ($request->id_produk as $id) {
            $produk = $this->ProdukService->find($id);
            $dataproduk[] = $produk;
        }
    }
}