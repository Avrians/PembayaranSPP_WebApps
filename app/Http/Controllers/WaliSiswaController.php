<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;

class WaliSiswaController extends Controller
{
    public function store(Request $request)
    {
        $requestData = $request->validate(
            [
                'siswa_id' => 'required',
                'wali_id' => 'required|exists:users,id',
            ],
            [
                'siswa_id.required' => 'Siswa harus diisi',
                'wali_id.required' => 'Wali harus diisi',
            ]
        );
        $wali = User::find($requestData['wali_id']);
        $siswa = Siswa::find($requestData['siswa_id']);
        $siswa->wali_id = $wali->id;
        $siswa->wali_status = 'oke';
        $siswa->save();
        flash('Data sudah disimpan')->success();
        return back();
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->wali_id = null;
        $siswa->wali_status = null;
        $siswa->save();
        flash('Data sudah dihapus')->success();
        return back();
    }
}
