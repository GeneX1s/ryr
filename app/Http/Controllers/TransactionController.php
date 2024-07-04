<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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

class TransactionController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function show(Transaction $transaction, Ingredients $ingredients)
  {
    // dd($transaction->id);
    // $ingredients = Ingredients::get();
    // return view('dashboard.transactions.group_edit', [
    //   'transaction' => $transaction,
    //   'ingredients' => $ingredients,
    // ]);
  }


  public function index(Request $request)
  {
    $name_search = $request->name;
    $jenis_search = $request->jenis;
    $start_date = $request->start_date;
    $end_date = $request->end_date;

    $transactions = Transaction::query()
      ->when($name_search, function ($query) use ($name_search) {
        return $query->where('nama', 'like', '%' . $name_search . '%');
      })
      ->when($jenis_search, function ($query) use ($jenis_search) {
        return $query->where('jenis', 'like', '%' . $jenis_search . '%');
      })
      ->when($start_date, function ($query) use ($start_date, $end_date) {
        return $query->whereDate('created_at', '>=', $start_date)
          ->whereDate('created_at', '<=', $end_date);
      })
      // ->where('status', 'Deleted')
      ->get();

    $total = 0;
    $pendapatan = 0;
    $pengeluaran = 0;
    $data = [];
    // foreach ($transactions as $transaction) {

    $plus = 0;
    $minus = 0;
    $pluses = $transactions->where('tipe', 'Pendapatan')->where('status', 'Active')->pluck('nominal')->all();
    $minuses = $transactions->where('tipe', 'Pengeluaran')->where('status', 'Active')->pluck('nominal')->all();
    foreach ($pluses as $plus) {
      $total = $total + $plus;
      $pendapatan = $pendapatan + $plus;
    }
    foreach ($minuses as $minus) {
      $total = $total - $minus;
      $pengeluaran = $pengeluaran + $minus;
    }
    // }
    // foreach ($transactions as $transaction) {


    //   $data[] = [
    //     'id' => $transaction->id,
    //     'nama' => $transaction->nama,
    //     'harga' => $transaction->harga,
    //     'deskripsi' => $transaction->deskripsi,
    //     'foto' => $transaction->foto,
    //     'jenis_1' => $transaction->jenis_1,
    //     'jenis_2' => $transaction->jenis_2,
    //     'time' => $transaction->_timestamp,
    //   ];
    // }

    // dd($data);
    return view('dashboard.transactions.index', [
      // 'transactions' => $data,
      'transactions' => $transactions,
      'total' => $total,
      'pendapatan' => $pendapatan,
      'pengeluaran' => $pengeluaran,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {


    return view('dashboard.transactions.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, User $user)
  {
    // dd($request->all());
    // dd(Auth::id());
    $author = User::where('id', Auth::id())->first()->name;
    $request->validate([
      'nama' => 'required',
      'jenis' => 'required',
      'tipe' => 'required',
      'nominal' => 'required',
      'biaya_tambahan' => 'nullable',
      'deskripsi' => 'nullable',
      '_author' => 'nullable',
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
      'status' => "Pending",
    ]);
    $input = $request->all();
    // $input['created_at'] = Carbon::parse($today)->toString();
    $input['created_at'] = Carbon::now();
    $input['updated_at'] = Carbon::now();
    $input['status'] = "Active";
    $input['_author'] = $author;

    // dd($input);
    Transaction::create($input);

    return redirect('/dashboard/transactions/index')->with('success', 'New transaction has been added');
  }


  public function destroy(Transaction $transaction, Request $request)
  {

    $transaction = Transaction::where('id', $transaction->id)->first();
    // $transaction->delete();
    // dd($transaction);
    $transaction->update([
      "status" => "Deleted",
      "deleted_at" => Carbon::now(),
    ]);

    // Transaction::destroy($transaction->id);

    return redirect('/dashboard/transactions/index')->with('success', 'Transaction has been deleted');
  }
}
