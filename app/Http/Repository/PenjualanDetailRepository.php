<?php

namespace App\Http\Repository;

use App\Models\Member;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use App\Models\Setting;
use Illuminate\Http\Request;

class PenjualanDetailRepository
{
    protected $member;
    protected $penjualan;
    protected $penjualandetail;
    protected $produk;
    protected $setting;

    public function __construct(Member $member, Penjualan $penjualan, PenjualanDetail $penjualandetail, Produk $produk, Setting $setting)
    {
        $this->member = $member;
        $this->penjualan = $penjualan;
        $this->penjualandetail = $penjualandetail;
        $this->produk = $produk;
        $this->setting = $setting;
    }

    public function all()
    {
        return $this->produk::orderBy('nama_produk')->get();
    }

    public function all2()
    {
        return $this->member::orderBy('nama')->get();
    }
    
    public function all3()
    {
        return $this->setting::first()->diskon ?? 0;
    }
    
    public function all4()
    {
        $id_penjualan = session('id_penjualan');
        return $this->penjualan::find($id_penjualan);
    }

    public function all5()
    {
        return $penjualan->member ?? new $this->member();;
    }

    public function find($id)
    {
        return $this->penjualan->find($id);
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
        $produk = $this->produk::where('id_produk', $request->id_produk)->first();
        if (! $produk) {
            return response()->json('Data gagal disimpan', 400);
        }

        $detail = new $this->penjualandetail();
        $detail->id_penjualan = $request->id_penjualan;
        $detail->id_produk = $produk->id_produk;
        $detail->harga_jual = $produk->harga_jual;
        $detail->jumlah = 1;
        $detail->diskon = $produk->diskon;
        $detail->subtotal = $produk->harga_jual - ($produk->diskon / 100 * $produk->harga_jual);;
        $detail->save();

        return;

    }
    


    public function show($id)
    {
        return $this->penjualandetail::with('produk')->where('id_penjualan', $id)->get();
    }

    public function update($request, $id)
    {

        $detail = $this->penjualandetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_jual * $request->jumlah - (($detail->diskon * $request->jumlah) / 100 * $detail->harga_jual);;
        $detail->update();

        return $detail;
    }

    public function delete($id)
    {
        $detail = $this->penjualandetail::find($id);
        $detail->delete();
    }

    public function setting()
    {
        $setting = $this->setting::first();
        
        return $setting;
    }
}