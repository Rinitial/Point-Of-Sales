<?php

namespace App\Http\Repository;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Member;
use App\Models\Penjualan;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class DashboardRepository
{
    protected $kategori;

    public function __construct(Kategori $kategori, Produk $produk, Supplier $supplier, Member $member, Penjualan $penjualan, Pembelian $pembelian, Pengeluaran $pengeluaran)
    {
        $this->kategori = $kategori;
        $this->produk = $produk;
        $this->supplier = $supplier;
        $this->member = $member;
        $this->penjualan = $penjualan;
        $this->pembelian = $pembelian;
        $this->pengeluaran = $pengeluaran;
    }

    public function all()
    {
        return $this->kategori->count();
    }
    
    public function all2()
    {
        return $this->produk->count();
    }
    
    public function all3()
    {
        return $this->supplier->count();
    }

    public function all4()
    {
        return $this->member->count();
    }
    
    public function all5($tanggal_awal)
    {
        return $this->penjualan::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('bayar');

    }
    
    public function all6($tanggal_awal)
    {
        return $this->pembelian::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('bayar');

    }
    
    public function all7($tanggal_awal)
    {
        return $this->pengeluaran::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('nominal');

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