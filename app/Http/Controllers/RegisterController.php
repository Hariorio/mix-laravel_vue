<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function index() 
    {
        //return view('dt');
        $data = ['tes'];
       // dd($data);
        return view('register.index', [
            'nama' => 'ole'
        ]);   
    }

    public function store(Request $request) 

    {
        $datauser = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|max:255',
            'username' => ['required','min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $datauser['password'] = bcrypt($datauser['password']);
        
        $request->session()->flash('success', 'Selamat Anda Berhasil Registrasi .. !');
                        
        User::create($datauser);

        return redirect('/');
    }
}
