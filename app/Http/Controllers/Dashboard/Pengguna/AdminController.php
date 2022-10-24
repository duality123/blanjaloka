<?php

namespace App\Http\Controllers\Dashboard\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $admins = DB::table('users')->select('id', 'email')->limit(10)->get();
        return Inertia::render('Dashboard/Pengguna/Admin', ['admins' => $admins]);
    }

    public function store(Request $request)
    {

        dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        $newAdmin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $newAdmin->assignRole('admin');
        return redirect('dashboard/pengguna/admin');
    }

    public function edit($id)
    {
        $admin = User::find($id);

        return response($admin);
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('pengguna.admin.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('pengguna.admin.index');
    }
}
