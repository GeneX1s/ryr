<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
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

  public function show(Schedule $Schedule)
  {
    // dd($Schedule->id);
    // $ingredients = Ingredients::get();
    // return view('dashboard.Schedules.group_edit', [
    //   'Schedule' => $Schedule,
    //   'ingredients' => $ingredients,
    // ]);
  }


  public function index(Request $request)
  {
    $name_search = $request->name;
    $jenis_search = $request->jenis;
    $start_date = $request->start_date;
    $end_date = $request->end_date;

    $Schedules = Schedule::query()
      ->when($name_search, function ($query) use ($name_search) {
        return $query->where('nama', 'like', '%' . $name_search . '%');
      })
      ->when($jenis_search, function ($query) use ($jenis_search) {
        return $query->where('jenis', 'like', '%' . $jenis_search . '%');
      })
      ->get();

    $total = 0;
    $pendapatan = 0;
    $pengeluaran = 0;
    $data = [];

    $plus = 0;
    $minus = 0;
    $pluses = $Schedules->where('tipe', 'Pendapatan')->where('status', 'Active')->pluck('nominal')->all();
    $minuses = $Schedules->where('tipe', 'Pengeluaran')->where('status', 'Active')->pluck('nominal')->all();
    foreach ($pluses as $plus) {
      $total = $total + $plus;
      $pendapatan = $pendapatan + $plus;
    }
    foreach ($minuses as $minus) {
      $total = $total - $minus;
      $pengeluaran = $pengeluaran + $minus;
    }

    // dd($data);
    return view('dashboard.Schedules.index', [
      // 'Schedules' => $data,
      'Schedules' => $Schedules,
      'total' => $total,
      'pendapatan' => $pendapatan,
      'pengeluaran' => $pengeluaran,
    ]);
  }

  public function create(Request $request)
  {


    return view('dashboard.Schedules.create');
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
    Schedule::create($input);

    return redirect('/dashboard/Schedules/index')->with('success', 'New Schedule has been added');
  }

  public function edit(Schedule $schedule)
  {
    return view('dashboard.schedules.edit', [
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
  public function update(Request $request, Schedule $schedule)
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

    Schedule::where('id', $schedule->id)->update($validatedData);
    // Schedule::where('id',$request->id)->update($validatedData);

    return redirect('/dashboard/schedules/index')->with('success', 'Schedule has been updated');
  }

  public function destroy(Schedule $Schedule, Request $request)
  {

    $Schedule = Schedule::where('id', $Schedule->id)->first();
    // $Schedule->delete();
    // dd($Schedule);
    $Schedule->update([
      "status" => "Deleted",
      "deleted_at" => Carbon::now(),
    ]);

    // Schedule::destroy($Schedule->id);

    return redirect('/dashboard/Schedules/index')->with('success', 'Schedule has been deleted');
  }
}
