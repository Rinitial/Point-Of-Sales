<?php

namespace App\Http\Repository;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianDetailRepository
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
        $id_pembelian = session('id_pembelian');

        return $id_pembelian;
    }

    public function all3()
    {
        $produk = $this->produk::orderBy('nama_produk')->get();

        return $produk;
    }

    public function all4()
    {
        $supplier = $this->supplier::find(session('id_supplier'));

        return $supplier;
    }

    public function all5()
    {   
        $id_pembelian = session('id_pembelian');

        $diskon = $this->pembelian::find($id_pembelian)->diskon ?? 0;

        return $diskon;
    }

    public function all2($id)
    {
        $detail = $this->pembeliandetail::with('produk')
            ->where('id_pembelian', $id)
            ->get();

        return $detail;
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
        $produk = $this->produk::where('id_produk', $request->id_produk)->first();
        if (! $produk) {
            return response()->json('Data gagal disimpan', 400);
        }

        return $produk;
    }

    public function store2($request)
    {   
        $produk = $this->produk::where('id_produk', $request->id_produk)->first();

        $detail = new $this->pembeliandetail();
        $detail->id_pembelian = $request->id_pembelian;
        $detail->id_produk = $produk->id_produk;
        $detail->harga_beli = $produk->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->harga_beli;
        $detail->save();

        return $detail;
    }

    public function show($id)
    {
        return $this->pembeliandetail::with('produk')->where('id_pembelian', $id)->get();

    }

    public function update($request, $id)
    {

        $detail = $this->pembeliandetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_beli * $request->jumlah;
        $detail->update();

        return $detail;
    }

    public function delete($id)
    {
        $detail = $this->pembeliandetail::find($id);
        $detail->delete();
    }
}