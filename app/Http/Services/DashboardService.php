<?php

namespace App\Http\Services;

use App\Http\Repository\DashboardRepository;

class DashboardService
{
    protected $DashboardRepository;

    public function __construct(DashboardRepository $DashboardRepository)
    {
        $this->DashboardRepository = $DashboardRepository;
    }

    public function all()
    {
        return $this->DashboardRepository->all();
    }
    
    public function all2()
    {
        return $this->DashboardRepository->all2();
    }
    
    public function all3()
    {
        return $this->DashboardRepository->all3();
    }
    
    public function all4()
    {
        return $this->DashboardRepository->all4();
    }
    
    public function all5($tanggal_awal)
    {
        return $this->DashboardRepository->all4($tanggal_awal);
    }
    
    public function all6($tanggal_awal)
    {
        return $this->DashboardRepository->all4($tanggal_awal);
    }
    
    public function all7($tanggal_awal)
    {
        return $this->DashboardRepository->all4($tanggal_awal);
    }
    
    public function find($id)
    {
        return $this->DashboardRepository->find($id);
    }

    public function store(array $validated)
    {
        return $this->DashboardRepository->store($validated);
    }

    public function create($data)
    {
        return $this->DashboardRepository->create($data);
    }

    public function update($validated, $id)
    {
        return $this->DashboardRepository->update($validated, $id);
    }

    public function delete($id)
    {
        return $this->DashboardRepository->delete($id);
    }
}