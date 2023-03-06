<?php

namespace App\Http\Repository;

use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;

class MemberRepository
{
    protected $member;
    protected $setting;

    public function __construct(Member $member, Setting $setting)
    {
        $this->member = $member;
        $this->setting = $setting;
    }

    public function all()
    {
        return $this->member::orderBy('kode_member')->get();

    }

    public function latest()
    {
        return $this->member::latest()->first();
    }

    public function setting()
    {
        return $this->setting::latest()->first();
    }

    public function find($id)
    {
        return $this->member->find($id);
    }

    public function store(array $validated)
    {
        
    }

    public function create(array $data)
    {
        return $this->member->create($data);
    }

    public function update($validated, $id)
    {

        $member = $this->member->find($id);
        $member->nama = $validated['nama'];
        $member->telepon = $validated['telepon'];
        $member->alamat = $validated['alamat'];
        $member->update();

        return $member;
    }

    public function delete($id)
    {
        $member = $this->member->find($id);
        $member->delete();
    }
}