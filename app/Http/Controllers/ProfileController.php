<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('Profile/Index', ['user' => $user]);
    }

    public function simpanDataDiri(Request $request)
    {


        $user = User::find($request->id);
        // $request->validate([
        //     // 'nama' => 'required',
        //     // 'tempat_lahir' => 'required',
        //     // 'tanggal_lahir' => 'required',
        //     // 'pendidikan_terakhir' => 'required',
        //     // 'alamat' => 'required',
        //     // 'kelurahan' => 'required',
        //     // 'kecamatan' => 'required',
        //     // 'kebupaten' => 'required',
        //     // 'provinsi' => 'required',
        //     'fotoProfile' => 'required|image|mimes:jpeg,jpg,png|max:2000',
        //     'fotoKTP' => 'required|image|mimes:jpeg,jpg,png|max:2000',
        //     'fotoSelfie' => 'required|image|mimes:jpeg,jpg,png|max:2000',
        // ]);


        $fotoProfile = $request->file('fotoProfile');
        $fotoProfile->storeAs('public/foto_profile', $fotoProfile->hashName());
        $fotoKTP = $request->file('fotoKTP');
        $fotoKTP->storeAs('public/foto_ktp', $fotoKTP->hashName());
        $fotoSelfie = $request->file('fotoSelfie');
        $fotoSelfie->storeAs('public/foto_selfie', $fotoSelfie->hashName());



        $user->update([
            'nama' => $request->nama,
            'tempat_kelahiran' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'alamat' => $request->alamat,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'foto_profile' => $fotoProfile->hashName(),
            'ktp' => $fotoKTP->hashName(),
            'foto_selfie' => $fotoSelfie->hashName(),
        ]);

        return redirect()->intended('/');
    }

    public function changePassword()
    {
        return Inertia::render('Profile/ChangePassword');
    }

    public function changeEmail()
    {
        return Inertia::render('Profile/ChangeEmail');
    }
}
