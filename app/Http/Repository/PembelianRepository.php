<?php

namespace App\Http\Repository;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianRepository
{
    protected $pembelian;
    protected $pembeliandetail;
    protected $produk;
    protected $supplier;

    public function __construct(Pembelian $pembelian, PembelianDetail $pembeliandetail, Produk $produk, Supplier $supplier)
    {
        $this->pembelian = $pembelian;
        $this->pembeliandetail = $pembeliandetail;
        $this->produk = $produk;
        $this->supplier = $supplier;
    }

    public function all()
    {
        return $this->supplier::orderBy('nama')->get();
    }

    public function all2()
    {
        return $this->pembelian::orderBy('id_pembelian', 'desc')->get();
    }

    public function find($id)
    {
        return $this->pembelian->find($id);
    }

    public function create($id)
    {
        $pembelian = new $this->pembelian;
        $pembelian->id_supplier = $id;
        $pembelian->total_item  = 0;
        $pembelian->total_harga = 0;
        $pembelian->diskon      = 0;
        $pembelian->bayar       = 0;
        $pembelian->save();

        session(['id_pembelian' => $pembelian->id_pembelian]);
        session(['id_supplier' => $pembelian->id_supplier]);

        return $pembelian;
    }

    public function store($request)
    {
        $pembelian = $this->pembelian::findOrFail($request->id_pembelian);
        $pembelian->total_item = $request->total_item;
        $pembelian->total_harga = $request->total;
        $pembelian->diskon = $request->diskon;
        $pembelian->bayar = $request->bayar;
        $pembelian->update();

        $detail = $this->pembeliandetail::where('id_pembelian', $pembelian->id_pembelian)->get();
        foreach ($detail as $item) {
            $produk = $this->produk::find($item->id_produk);
            $produk->stok += $item->jumlah;
            $produk->update();
        }

        return $pembelian;
        return $detail;
        return $produk;
    }

    public function show($id)
    {
        return $this->pembeliandetail::with('produk')->where('id_pembelian', $id)->get();

    }

    public function update($validated, $id)
    {

        $pembelian = $this->pembelian->find($id);
        $pembelian->nama_pembelian = $validated['nama_pembelian'];
        $pembelian->update();

        return $pembelian;
    }

    public function delete($id)
    {
        $pembelian = $this->pembelian->find($id);
        $detail    = $this->pembeliandetail::where('id_pembelian', $pembelian->id_pembelian)->get();
        foreach ($detail as $item) {
            $produk = $this->produk::find($item->id_produk);
            if ($produk) {
                $produk->stok -= $item->jumlah;
                $produk->update();
            }
            $item->delete();
        }

        $pembelian->delete();
    }
}