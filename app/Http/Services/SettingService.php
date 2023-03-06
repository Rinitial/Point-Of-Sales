<?php

namespace App\Http\Services;

use App\Http\Repository\SettingRepository;

class SettingService
{
    protected $SettingRepository;

    public function __construct(SettingRepository $SettingRepository)
    {
        $this->SettingRepository = $SettingRepository;
    }

    public function all()
    {
        return $this->SettingRepository->all();
    }

    public function find($id)
    {
        return $this->SettingRepository->find($id);
    }

    public function store($request)
    {
        return $this->SettingRepository->store($request);
    }

    public function create($data)
    {
        return $this->SettingRepository->create($data);
    }

    public function update($request)
    {
        return $this->SettingRepository->update($request);
    }

    public function delete($id)
    {
        return $this->SettingRepository->delete($id);
    }
}