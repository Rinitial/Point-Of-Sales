<?php

namespace App\Http\Repository;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierRepository
{
    protected $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function all()
    {
        return $this->supplier::orderBy('id_supplier', 'desc')->get();
    }

    public function find($id)
    {
        return $this->supplier->find($id);
    }

    public function store(array $validated)
    {
        $supplier = new $this->supplier;
        $supplier->nama = $validated['nama'];
        $supplier->telepon = $validated['telepon'];
        $supplier->alamat = $validated['alamat'];
        $supplier->save();

        return $supplier;
    }

    public function update($validated, $id)
    {

        $supplier = $this->supplier->find($id);
        $supplier->nama = $validated['nama'];
        $supplier->telepon = $validated['telepon'];
        $supplier->alamat = $validated['alamat'];
        $supplier->update();

        return $supplier;
    }

    public function delete($id)
    {
        $supplier = $this->supplier->find($id);
        $supplier->delete();
    }
}