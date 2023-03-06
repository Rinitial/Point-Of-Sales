<?php

namespace App\Http\Services;

use App\Http\Repository\SupplierRepository;

class SupplierService
{
    protected $SupplierService;

    public function __construct(SupplierRepository $SupplierRepository)
    {
        $this->SupplierRepository = $SupplierRepository;
    }

    public function all()
    {
        return $this->SupplierRepository->all();
    }

    public function find($id)
    {
        return $this->SupplierRepository->find($id);
    }

    public function store(array $validated)
    {
        return $this->SupplierRepository->store($validated);
    }

    public function create($data)
    {
        return $this->SupplierRepository->create($data);
    }

    public function update($validated, $id)
    {
        return $this->SupplierRepository->update($validated, $id);
    }

    public function delete($id)
    {
        return $this->SupplierRepository->delete($id);
    }
}