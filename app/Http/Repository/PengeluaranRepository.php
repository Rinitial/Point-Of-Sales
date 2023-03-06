<?php

namespace App\Http\Repository;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranRepository
{
    protected $pengeluaran;

    public function __construct(Pengeluaran $pengeluaran)
    {
        $this->pengeluaran = $pengeluaran;
    }

    public function all()
    {
        return $this->pengeluaran::orderBy('id_pengeluaran', 'desc')->get();
    }

    public function find($id)
    {
        return $this->pengeluaran->find($id);
    }

    public function store(array $validated)
    {
        $pengeluaran = new $this->pengeluaran;
        $pengeluaran->deskripsi = $validated['deskripsi'];
        $pengeluaran->nominal = $validated['nominal'];
        $pengeluaran->save();

        return $pengeluaran;
    }

    public function update($validated, $id)
    {

        $pengeluaran = $this->pengeluaran->find($id);
        $pengeluaran->deskripsi = $validated['deskripsi'];
        $pengeluaran->nominal = $validated['nominal'];
        $pengeluaran->update();

        return $pengeluaran;
    }

    public function delete($id)
    {
        $pengeluaran = $this->pengeluaran->find($id);
        $pengeluaran->delete();
    }
}