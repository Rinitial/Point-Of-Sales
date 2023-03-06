<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\SettingService;

class SettingController extends Controller
{
    protected $SettingService;

    public function __construct(SettingService $SettingService)
    {
        $this->SettingService = $SettingService;
    }

    public function index()
    {
        return view('setting.index');
    }

    public function show()
    {
        $setting = $this->SettingService->all();

        return $setting;
    }

    public function update(Request $request)
    {
        $setting = $this->SettingService->update($request);

        return response()->json('Data berhasil disimpan', 200);
    }
}