<?php

namespace App\Http\Services;

use App\Http\Repository\PenjualanDetailRepository;

class PenjualanDetailService
{
    protected $PenjualanDetailRepository;

    public function __construct(PenjualanDetailRepository $PenjualanDetailRepository)
    {
        $this->PenjualanDetailRepository = $PenjualanDetailRepository;
    }

    public function all()
    {
        return $this->PenjualanDetailRepository->all();
    }

    public function all3()
    {
        return $this->PenjualanDetailRepository->all3();
    }

    public function all4()
    {
        return $this->PenjualanDetailRepository->all4();
    }

    public function all5()
    {
        return $this->PenjualanDetailRepository->all5();
    }


    public function all2()
    {
        return $this->PenjualanDetailRepository->all2();
    }

    public function find($id)
    {
        return $this->PenjualanDetailRepository->find($id);
    }
    
    public function create($id)
    {
        return $this->PenjualanDetailRepository->create($id);
    }

    public function store($request)
    {
        return $this->PenjualanDetailRepository->store($request);
    }
    
    public function store2($request)
    {
        return $this->PenjualanDetailRepository->store2($request);
    }
    
    public function show($id)
    {
        return $this->PenjualanDetailRepository->show($id);
    }

    public function update($request, $id)
    {
        return $this->PenjualanDetailRepository->update($request, $id);
    }

    public function delete($id)
    {
        return $this->PenjualanDetailRepository->delete($id);
    }
}