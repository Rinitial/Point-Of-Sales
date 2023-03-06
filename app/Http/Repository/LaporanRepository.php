<?php

namespace App\Http\Repository;

use App\Models\Penjualan;
use App\Models\Pembelian;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class LaporanRepository
{
    protected $penjualan;
    protected $pembelian;
    protected $pengeluaran;

    public function __construct(Penjualan $penjualan, Pembelian $pembelian, Pengeluaran $pengeluaran)
    {
        $this->penjualan = $penjualan;
        $this->pembelian = $pembelian;
        $this->pengeluaran = $pengeluaran;
    }

    public function all($tanggal)
    {
        return $this->penjualan::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
    }
    
    public function all2($tanggal)
    {
        return $this->pembelian::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
    }
    
    public function all3($tanggal)
    {
        return $this->pengeluaran::where('created_at', 'LIKE', "%$tanggal%")->sum('nominal');
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