<?php

namespace App\Http\Repository;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingRepository
{
    protected $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function all()
    {
        return $this->setting::first();
    }

    public function find($id)
    {
        return $this->setting->find($id);
    }

    public function store($request)
    {
        $setting = new $this->setting();
        $setting->name = $request->name;
        $setting->email = $request->email;
        $setting->password = $request->password;
        $setting->level = 2;
        $setting->foto = '/img/setting.jpg';
        $setting->save();
    }

    public function update($request)
    {

        $setting = $this->setting::first();
        $setting->nama_perusahaan = $request->nama_perusahaan;
        $setting->telepon = $request->telepon;
        $setting->alamat = $request->alamat;
        $setting->diskon = $request->diskon;
        $setting->tipe_nota = $request->tipe_nota;

        if ($request->hasFile('path_logo')) {
            $file = $request->file('path_logo');
            $nama = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);

            $setting->path_logo = "/img/$nama";
        }

        if ($request->hasFile('path_kartu_member')) {
            $file = $request->file('path_kartu_member');
            $nama = 'logo-' . date('Y-m-dHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);

            $setting->path_kartu_member = "/img/$nama";
        }

        $setting->update();
        return $setting;
    }

    public function delete($id)
    {
        $setting = $this->setting->find($id);
        $setting->delete();
    }
}