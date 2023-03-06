<?php

namespace App\Http\Repository;

use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use App\Models\Setting;
use Illuminate\Http\Request;

class PenjualanRepository
{
    protected $penjualan;
    protected $penjualandetail;
    protected $produk;
    protected $setting;

    public function __construct(Penjualan $penjualan, PenjualanDetail $penjualandetail, Produk $produk, Setting $setting)
    {
        $this->penjualan = $penjualan;
        $this->penjualandetail = $penjualandetail;
        $this->produk = $produk;
        $this->setting = $setting;
    }

    public function all()
    {
        return $this->penjualan::with('member')->orderBy('id_penjualan', 'desc')->get();
    }

    public function all2($id)
    {
        return $this->penjualandetail::with('produk')->where('id_penjualan', $id)->get();
    }

    public function all3()
    {
        return $this->penjualan::find(session('id_penjualan'));

    }

    public function all4()
    {
        return $this->penjualandetail::with('produk')
        ->where('id_penjualan', session('id_penjualan'))
        ->get();
    }

    public function find($id)
    {
        return $this->pembelian->find($id);
    }

    public function create()
    {
        $penjualan = new $this->penjualan();
        $penjualan->id_member = null;
        $penjualan->total_item = 0;
        $penjualan->total_harga = 0;
        $penjualan->diskon = 0;
        $penjualan->bayar = 0;
        $penjualan->diterima = 0;
        $penjualan->id_user = auth()->id();
        $penjualan->save();

        session(['id_penjualan' => $penjualan->id_penjualan]);

        return $penjualan;
    }

    public function store($request)
    {
        $penjualan = $this->penjualan::findOrFail($request->id_penjualan);
        $penjualan->id_member = $request->id_member;
        $penjualan->total_item = $request->total_item;
        $penjualan->total_harga = $request->total;
        $penjualan->diskon = $request->diskon;
        $penjualan->bayar = $request->bayar;
        $penjualan->diterima = $request->diterima;
        $penjualan->update();

        $detail = $this->penjualandetail::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $item->diskon = $request->diskon;
            $item->update();

            $produk = $this->produk::find($item->id_produk);
            $produk->stok -= $item->jumlah;
            $produk->update();

        return $penjualan;
        return $detail;
        return $produk;
        }
    }

    public function show($id)
    {
        return $this->pembeliandetail::with('produk')->where('id_pembelian', $id)->get();

    }

    public function update($validated, $id)
    {

    }

    public function delete($id)
    {
        $penjualan = $this->penjualan::find($id);
        $detail    = $this->penjualandetail::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $produk = $this->produk::find($item->id_produk);
            if ($produk) {
                $produk->stok += $item->jumlah;
                $produk->update();
            }

            $item->delete();
        }

        $penjualan->delete();
    }

    public function setting()
    {
        $setting = $this->setting::first();
        
        return $setting;
    }
}