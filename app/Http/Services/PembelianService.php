<?php

namespace App\Http\Services;

use App\Http\Repository\PembelianRepository;

class PembelianService
{
    protected $PembelianRepository;

    public function __construct(PembelianRepository $PembelianRepository)
    {
        $this->PembelianRepository = $PembelianRepository;
    }

    public function all()
    {
        return $this->PembelianRepository->all();
    }

    public function all2()
    {
        return $this->PembelianRepository->all2();
    }

    public function find($id)
    {
        return $this->PembelianRepository->find($id);
    }
    
    public function create($id)
    {
        return $this->PembelianRepository->create($id);
    }

    public function store($request)
    {
        return $this->PembelianRepository->store($request);
    }

    public function show($id)
    {
        return $this->PembelianRepository->show($id);
    }

    public function update($validated, $id)
    {
        return $this->PembelianRepository->update($validated, $id);
    }

    public function delete($id)
    {
        return $this->PembelianRepository->delete($id);
    }
}