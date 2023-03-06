<?php

namespace App\Http\Services;

use App\Http\Repository\UserRepository;

class UserService
{
    protected $UserRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }

    public function view()
    {
        return $this->UserRepository->view();
    }

    public function all()
    {
        return $this->UserRepository->all();
    }

    public function find($id)
    {
        return $this->UserRepository->find($id);
    }

    public function store($request)
    {
        return $this->UserRepository->store($request);
    }

    public function create($data)
    {
        return $this->UserRepository->create($data);
    }

    public function update($request, $id)
    {
        return $this->UserRepository->update($request, $id);
    }

    public function delete($id)
    {
        return $this->UserRepository->delete($id);
    }
}