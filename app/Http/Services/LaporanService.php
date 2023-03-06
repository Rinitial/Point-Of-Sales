<?php

namespace App\Http\Services;

use App\Http\Repository\LaporanRepository;

class LaporanService
{
    protected $LaporanRepository;

    public function __construct(LaporanRepository $LaporanRepository)
    {
        $this->LaporanRepository = $LaporanRepository;
    }

    public function all($tanggal)
    {
        return $this->LaporanRepository->all($tanggal);
    }
    
    public function all2($tanggal)
    {
        return $this->LaporanRepository->all2($tanggal);
    }
    
    public function all3($tanggal)
    {
        return $this->LaporanRepository->all3($tanggal);
    }

    public function find($id)
    {
        return $this->LaporanRepository->find($id);
    }

    public function store(array $validated)
    {
        return $this->LaporanRepository->store($validated);
    }

    public function create($data)
    {
        return $this->LaporanRepository->create($data);
    }

    public function update($validated, $id)
    {
        return $this->LaporanRepository->update($validated, $id);
    }

    public function delete($id)
    {
        return $this->LaporanRepository->delete($id);
    }
}