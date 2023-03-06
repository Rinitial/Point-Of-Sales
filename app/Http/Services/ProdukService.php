<?php

namespace App\Http\Services;

use App\Http\Repository\ProdukRepository;

class ProdukService
{
    protected $ProdukRepository;

    public function __construct(ProdukRepository $ProdukRepository)
    {
        $this->ProdukRepository = $ProdukRepository;
    }

    public function index()
    {
        return $this->ProdukRepository->index();
    }

    public function all()
    {
        return $this->ProdukRepository->all();
    }

    public function latest()
    {
        return $this->ProdukRepository->latest();
    }

    public function find($id)
    {
        return $this->ProdukRepository->find($id);
    }

    public function findById($id, $request)
    {
        return $this->ProdukRepository->findById($id, $request);
    }

    // public function store(array $validated)
    // {

    //     return $this->ProdukRepository->store($validated);
    // }

    public function create(array $data)
    {
        return $this->ProdukRepository->create($data);
    }

    public function update($data, $id)
    {
        return $this->ProdukRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->ProdukRepository->delete($id);
    }

    public function deleteSelected($request)
    {
        return $this->ProdukRepository->deleteSelected($request);
    }

    public function cetakBarcode($request)
    {
        return $this->ProdukRepository->cetakBarcode($request);
    }
}