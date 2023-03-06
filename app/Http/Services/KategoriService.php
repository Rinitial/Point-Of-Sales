<?php

namespace App\Http\Services;

use App\Http\Repository\KategoriRepository;

class KategoriService
{
    protected $KategoriRepository;

    public function __construct(KategoriRepository $KategoriRepository)
    {
        $this->KategoriRepository = $KategoriRepository;
    }

    public function all()
    {
        return $this->KategoriRepository->all();
    }

    public function find($id)
    {
        return $this->KategoriRepository->find($id);
    }

    public function store(array $validated)
    {
        return $this->KategoriRepository->store($validated);
    }

    public function create($data)
    {
        return $this->KategoriRepository->create($data);
    }

    public function update($validated, $id)
    {
        return $this->KategoriRepository->update($validated, $id);
    }

    public function delete($id)
    {
        return $this->KategoriRepository->delete($id);
    }
}