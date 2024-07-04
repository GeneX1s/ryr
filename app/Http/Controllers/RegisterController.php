<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
  public function index()
  {
    return view('register', [
      'title' => 'Register'
    ]);
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'username' => ['required', 'min:3', 'max:255', 'unique:users'],
      'email' => 'required|email:dns|unique:users',
      'password' => 'required|min:5|max:255'
    ]);
    $id = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    //$validatedData['password'] = bcrypt($validatedData['password']);
    $validatedData['id'] = $id;
    $validatedData['password'] = Hash::make($validatedData['password']);

    User::create($validatedData);
    // $request->session()->flash('success','Registration successful!Please log in');
    return redirect('/login')->with('success', 'Registration successful!Please log in');
  }
  public function update(User $user, Request $request)
  {
    $validatedData = $request->validate([
      'password' => 'required|min:5|max:255'
    ]);
    $validatedData['password'] = Hash::make($validatedData['password']);
    $user->update($validatedData);
    return redirect('/login')->with('success', 'New password saved');
  }
}
