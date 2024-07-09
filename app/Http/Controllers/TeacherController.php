<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiResponse;
use App\Models\Ingredients;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function show(Teacher $teacher)
  {
    // dd($teacher->id);
    // $ingredients = Ingredients::get();
    // return view('dashboard.teachers.group_edit', [
    //   'Teacher' => $teacher,
    //   'ingredients' => $ingredients,
    // ]);
  }


  public function index(Request $request)
  {
    $name_search = $request->name;
    
    $teachers = Teacher::query()
      ->when($name_search, function ($query) use ($name_search) {
        return $query->where('name', 'like', '%' . $name_search . '%');
      })
      ->get();

    // dd($data);
    return view('dashboard.teachers.index', [
      // 'teachers' => $data,
      'teachers' => $teachers,
    ]);
  }

  public function create(Request $request)
  {


    return view('dashboard.teachers.create');
  }

  public function store(Request $request, User $user)
  {
    // dd($request->all());
    // dd(Auth::id());
    $author = User::where('id', Auth::id())->first()->name;
    $request->validate([
      'title' => 'required',
      'harga' => 'required',
      'day' => 'required',
      'time' => 'required',
      'start_time' => 'required',
      'end_time' => 'required',
    ]);
    $input = $request->all();

    // dd($input);
    Teacher::create($input);

    return redirect('/dashboard/teachers/index')->with('success', 'New Teacher has been added');
  }

  public function edit(Teacher $schedule)
  {
    return view('dashboard.teachers.edit', [
      'schedule' => $schedule,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Book  $book
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Teacher $schedule)
  {
    $data = [
      'title' => 'required',
      'harga' => 'required',
      'day' => 'required',
      'time' => 'required',
      'start_time' => 'required',
      'end_time' => 'required',
    ];


    $validatedData = $request->validate($data);

    if ($request->hasFile('foto')) {
      if ($request->oldImage) {
        Storage::delete($request->oldImage);
      }
      $imagePath = $request->file('foto');
      $imageName = 'assets/img/schedule/' . $imagePath->getClientOriginalName();


      $imagePath->move(public_path('assets/img/schedule'), $imageName);
      $validatedData['foto'] = $imageName;
    } else {
      $validatedData['foto'] = null;
    }

    Teacher::where('id', $schedule->id)->update($validatedData);
    // Teacher::where('id',$request->id)->update($validatedData);

    return redirect('/dashboard/teachers/index')->with('success', 'Teacher has been updated');
  }

  public function destroy(Teacher $teacher, Request $request)
  {

    $teacher = Teacher::where('id', $teacher->id)->first();
    // $teacher->delete();
    // dd($teacher);
    $teacher->update([
      "status" => "Deleted",
      "deleted_at" => Carbon::now(),
    ]);

    // Teacher::destroy($teacher->id);

    return redirect('/dashboard/teachers/index')->with('success', 'Teacher has been deleted');
  }
}
