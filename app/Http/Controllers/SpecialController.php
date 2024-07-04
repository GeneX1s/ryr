<?php

namespace App\Http\Controllers;

use App\Models\Special;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Hash;

class SpecialController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $name_search = $request->name;
    $kategori_search = $request->kategori;

    $specials = Special::query()
      ->when($name_search, function ($query) use ($name_search) {
        return $query->where('nama', 'like', '%' . $name_search . '%');
      })
      ->when($kategori_search, function ($query) use ($kategori_search) {
        return $query->where('kategori_1', 'like', '%' . $kategori_search . '%');
      })
      ->get();

    $data = [];

    foreach ($specials as $special) {

      $data[] = [
        'id' => $special->id,
        'title' => $special->title,
        'header_1' => $special->header_1,
        'header_2' => $special->header_2,
        'desc' => $special->desc,
        'foto' => $special->foto,
        'time' => $special->_timestamp,
      ];
    }

    return view('dashboard.specials.index', [
      // 'specials' => $data,
      'specials' => $specials,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {


    return view('dashboard.specials.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required',
      'header_1' => 'required',
      'header_2' => 'required',
      'desc' => 'required',
      'foto' => 'image|file',
    ]);

    $input = $request->all();

    if ($request->hasFile('foto')) {
      $imagePath = $request->file('foto');
      $imageName = 'assets/img/special/' . $imagePath->getClientOriginalName();


      $imagePath->move(public_path('assets/img/special'), $imageName);
      // $imagePath->move('public/assets/img/special',$imageName);
      $input['foto'] = $imageName;
    } else {
      // Handle case where no file is uploaded
      $input['foto'] = null; // Or any default value you want
    }

    Special::create($input);

    return redirect('/dashboard/specials/index')->with('success', 'New special has been added');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Book  $book
   * @return \Illuminate\Http\Response
   */

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Book  $book
   * @return \Illuminate\Http\Response
   */
  public function edit(Special $special)
  {
    return view('dashboard.specials.edit', [
      'special' => $special,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Book  $book
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Special $special)
  {
    $data = [
      'title' => 'required',
      'header_1' => 'required',
      'header_2' => 'required',
      'desc' => 'required',
      'foto' => 'image|file',
    ];


    $validatedData = $request->validate($data);

    if ($request->hasFile('foto')) {
      if ($request->oldImage) {
        Storage::delete($request->oldImage);
      }
      $imagePath = $request->file('foto');
      $imageName = 'assets/img/special/' . $imagePath->getClientOriginalName();


      $imagePath->move(public_path('assets/img/special'), $imageName);
      $validatedData['foto'] = $imageName;
    } else {
      $validatedData['foto'] = null;
    }

    Special::where('id', $special->id)->update($validatedData);
    // Special::where('id',$request->id)->update($validatedData);

    return redirect('/dashboard/specials/index')->with('success', 'Special has been updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Book  $book
   * @return \Illuminate\Http\Response
   */
  public function destroy(Special $special)
  {
    if ($special->foto) {
      Storage::delete($special->foto);
    }

    Special::destroy($special->id);

    return redirect('/dashboard/specials/index')->with('success', 'Special has been deleted');
  }

  public function uploadImage($file)
  {
    // Validate the uploaded file
    if (!$file->isValid()) {
      return response()->json(['error' => 'Invalid file'], 400);
    }

    // Define the destination directory
    $destinationPath = 'public/assets/img/special';

    // Store the file in the specified directory
    $path = $file->store($destinationPath);

    // Return the path where the file is stored
    return $path;
  }
}
