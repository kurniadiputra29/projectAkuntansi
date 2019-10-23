<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest')->except('logout', 'login', 'enter', 'register', 'inputregister');
    }

    public function login()
    {
      return view('auth.login.index');
    }

    public function enter(Request $request)
    {

    	$credentials = $request->only('email','password');
    	//return $credentials;//untuk mengecek credentials => bentuknya objek
    	$check = Auth::attempt($credentials); //untuk cek
    	if ($check) {
    		return redirect()->intended('/dasbor');
    	} else {
    		return redirect('/login');
    	}
    }
    public function logout()
    {
    	Auth::logout();
        return redirect('/login');
    }
    public function register()
    {
      return view('auth.register.index');
    }

    public function inputregister(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi !!!',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
        ];
        $this->validate($request,[
            'foto' => 'required',
            'nama' => 'required',
            'email' => 'unique:users,email|required',
            'password' => 'required|min:5', 
        ],$messages);
        
        $data           = new User;
        $data->nama     = $request->nama;
        $data->email    = $request->email;
        $data->password = bcrypt($request->password);

        $nama_file = $request->file('foto');
        $path = $nama_file->store('public/foto'); // ini akan tersimpan pada storage, app, public, files.
        $data->foto = $path;
        $data->save();
        return redirect('/login')->with('Success', 'Data anda telah berhasil di input !');
    }
}
