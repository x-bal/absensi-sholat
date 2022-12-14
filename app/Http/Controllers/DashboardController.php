<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function profile()
    {
        return view('dashboard.profile');
    }

    public function update(Request $request)
    {
        $attr = $request->validate([
            'username' => 'required|string|min:5|unique:users,username,' . auth()->user()->id,
            'name' => 'required|string',
            'password' => 'nullable|min:6|',
            'confirm' => 'required_with:password|same:password',
            'foto' => 'mimes:jpg, jpeg, png'
        ]);

        try {
            DB::beginTransaction();

            $user = User::find(auth()->user()->id);

            if ($request->password) {
                $pass = bcrypt($request->password);
            } else {
                $pass = $user->password;
            }

            if ($request->file('foto')) {
                $user->foto != NULL ? Storage::delete($user->foto) : '';
                $foto = $request->file('foto');
                $fotoUrl = $foto->storeAs('users', Str::slug($request->name) . '-' . Str::random(6) . '.' . $foto->extension());
            } else {
                $fotoUrl = $user->foto;
            }

            $attr['password'] = $pass;
            $attr['foto'] = $fotoUrl;

            $user->update($attr);

            DB::commit();

            return back()->with('success', 'Update profile berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
