<?php

namespace App\Http\Services;

use App\Http\Repository\MemberRepository;

class MemberService
{
    protected $MemberRepository;

    public function __construct(MemberRepository $MemberRepository)
    {
        $this->MemberRepository = $MemberRepository;
    }

    public function all()
    {
        return $this->MemberRepository->all();
    }

    public function latest()
    {
        return $this->MemberRepository->latest();
    }
    
    public function setting()
    {
        return $this->MemberRepository->setting();
    }

    public function find($id)
    {
        return $this->MemberRepository->find($id);
    }

    public function store(array $validated)
    {
        return $this->MemberRepository->store($validated);
    }

    public function create(array $data)
    {
        return $this->MemberRepository->create($data);
    }

    public function update($validated, $id)
    {
        return $this->MemberRepository->update($validated, $id);
    }

    public function delete($id)
    {
        return $this->MemberRepository->delete($id);
    }
}