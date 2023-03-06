<?php

namespace App\Http\Services;

use App\Http\Repository\PembelianDetailRepository;

class PembelianDetailService
{
    protected $PembelianDetailRepository;

    public function __construct(PembelianDetailRepository $PembelianDetailRepository)
    {
        $this->PembelianDetailRepository = $PembelianDetailRepository;
    }

    public function all()
    {
        return $this->PembelianDetailRepository->all();
    }

    public function all3()
    {
        return $this->PembelianDetailRepository->all3();
    }

    public function all4()
    {
        return $this->PembelianDetailRepository->all4();
    }

    public function all5()
    {
        return $this->PembelianDetailRepository->all5();
    }


    public function all2($id)
    {
        return $this->PembelianDetailRepository->all2($id);
    }

    public function find($id)
    {
        return $this->PembelianDetailRepository->find($id);
    }
    
    public function create($id)
    {
        return $this->PembelianDetailRepository->create($id);
    }

    public function store($request)
    {
        return $this->PembelianDetailRepository->store($request);
    }
    
    public function store2($request)
    {
        return $this->PembelianDetailRepository->store2($request);
    }
    
    public function show($id)
    {
        return $this->PembelianDetailRepository->show($id);
    }

    public function update($request, $id)
    {
        return $this->PembelianDetailRepository->update($request, $id);
    }

    public function delete($id)
    {
        return $this->PembelianDetailRepository->delete($id);
    }
}