<?php

namespace App\Http\Services;

use App\Http\Repository\PengeluaranRepository;

class PengeluaranService
{
    protected $PengeluaranRepository;

    public function __construct(PengeluaranRepository $PengeluaranRepository)
    {
        $this->PengeluaranRepository = $PengeluaranRepository;
    }

    public function all()
    {
        return $this->PengeluaranRepository->all();
    }

    public function find($id)
    {
        return $this->PengeluaranRepository->find($id);
    }

    public function store(array $validated)
    {
        return $this->PengeluaranRepository->store($validated);
    }

    public function create($data)
    {
        return $this->PengeluaranRepository->create($data);
    }

    public function update($validated, $id)
    {
        return $this->PengeluaranRepository->update($validated, $id);
    }

    public function delete($id)
    {
        return $this->PengeluaranRepository->delete($id);
    }
}