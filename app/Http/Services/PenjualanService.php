<?php

namespace App\Http\Services;

use App\Http\Repository\PenjualanRepository;

class PenjualanService
{
    protected $PenjualanRepository;

    public function __construct(PenjualanRepository $PenjualanRepository)
    {
        $this->PenjualanRepository = $PenjualanRepository;
    }

    public function all()
    {
        return $this->PenjualanRepository->all();
    }

    public function all2($id)
    {
        return $this->PenjualanRepository->all2($id);
    }

    public function all3()
    {
        return $this->PenjualanRepository->all3();
    }

    public function all4()
    {
        return $this->PenjualanRepository->all4();
    }

    public function find($id)
    {
        return $this->PenjualanRepository->find($id);
    }
    
    public function create()
    {
        return $this->PenjualanRepository->create();
    }

    public function store($request)
    {
        return $this->PenjualanRepository->store($request);
    }

    public function show($id)
    {
        return $this->PenjualanRepository->show($id);
    }

    public function update($validated, $id)
    {
        return $this->PenjualanRepository->update($validated, $id);
    }

    public function delete($id)
    {
        return $this->PenjualanRepository->delete($id);
    }

    public function setting()
    {
        return $this->PenjualanRepository->setting();
    }
}