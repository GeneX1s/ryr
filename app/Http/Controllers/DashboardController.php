<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\User;
use DateTime;
use App\Models\Special;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    $transactions = Transaction::get();
    $specials = Special::get();
    $month_now = Carbon::now()->format('m');
    $year_now = Carbon::now()->format('Y');

    $january = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '01'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();


    $january_b = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '01'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $januari = $january - $january_b;

    $february = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '02'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $february_b = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '02'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $februari = $february - $february_b;

    $march = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '03'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $march_b = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '03'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $maret = $march - $march_b;

    $apriil = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '04'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $apriil_b = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '04'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $april = $apriil - $apriil_b;

    $may = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '05'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $may_b = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '05'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $mei = $may - $may_b;

    $june = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '06'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $june_b = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '06'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $juni = $june - $june_b;

    $july = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '07'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $july_b = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '07'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $juli = $july - $july_b;

    $august = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '08'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $august_b = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '08'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $agustus = $august - $august_b;

    $septemberr = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '09'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $septemberr_b = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '09'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $september = $septemberr - $septemberr_b;

    $october = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '10'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $october_b = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '10'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $oktober = $october - $october_b;

    $novemberr = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '11'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $novemberr_b = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '11'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $november = $novemberr - $novemberr_b;

    $december = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '12'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $december_b = $transactions->filter(function ($transaction) use ($year_now) {
      $transaction_dt = new DateTime($transaction->created_at);
      return $transaction_dt->format('m') === '12'
        && $transaction_dt->format('Y') === $year_now
        && $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $desember = $december - $december_b;

    $sum = $transactions->filter(function ($transaction) use ($year_now) {
      return $transaction->tipe === 'Pendapatan'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();

    $sub = $transactions->filter(function ($transaction) use ($year_now) {
      return $transaction->tipe === 'Pengeluaran'
        && $transaction->status === 'Active';
    })->pluck('nominal')->sum();


    // $transactions = $transactions->sortBy('created_at');

    $transaction_first = $transactions->sortBy('created_at')->first()?->created_at;


    $year_first = Carbon::parse($transaction_first)->format('Y');

    $earning_m = ($sum - $sub) / $month_now; // Monthly earnings: income - expenses
    $earning_y = 0; // default value

    // Check if the difference between $year_now and $year_first is not zero before dividing
    if ($year_now != $year_first) {
      $earning_y = ($sum - $sub) / ($year_now - $year_first);
    }


    $orders = Order::where('status', 'Pending')->get();

    $area_chart = [$januari, $februari, $maret, $april, $mei, $juni, $juli, $agustus, $september, $oktober, $november, $desember];
    $order_amount = count($orders);
    // foreach ($transactions as $transaction) {
    // dd($area_chart);;
    return view('dashboard.index', [
      'earning_m' => $earning_m,
      'earning_y' => $earning_y,
      'area_chart' => $area_chart,
      'order_amount' => $order_amount,
      'specials' => $specials,
    ]);
  }



  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create_user(Request $request)
  {


    return view('dashboard.posts.create_user');

    // User::create([
    //     'name' => $request->name,
    //     'username' => $request->username,
    //     'email' => $request->email,
    //     'nip' => $request->nip,
    //     'password' => bcrypt($request->password),
    //     'is_admin' => $request->is_admin,
    // ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $userData = $request->validate([
      'name' => 'required|min:1|max:90',
      'username' => 'required|unique:users',
      'nip' => 'required|unique:users',
      'email' => 'required|unique:users',
      'password' => 'required',
      'is_admin' => 'nullable',
    ]);
    $userData['password'] = Hash::make($userData['password']);

    User::create($userData);

    return redirect('/dashboard/posts/employees')->with('success', 'New user has been added');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Book  $book
   * @return \Illuminate\Http\Response
   */
  // public function show(Rating $rating)
  // {
  //     $ratings = Rating::get();

  //     foreach ($ratings as $key => $rating) {
  //         $id = $rating->id;
  //         $nama = $rating->nama;
  //         $email = $rating->email;
  //         $komen = $rating->komen;
  //         $nip = $rating->nip;
  //         $pegawai = $rating->employee_name;
  //         $review = 0;
  //         $sangat_tidak_puas = Rating::where('id', $rating->id)->where('sangat_tidak_puas', 1)->first();
  //         $tidak_puas = Rating::where('id', $rating->id)->where('tidak_puas', 1)->first();
  //         $sedang = Rating::where('id', $rating->id)->where('sedang', 1)->first();
  //         $puas = Rating::where('id', $rating->id)->where('puas', 1)->first();
  //         $sangat_puas = Rating::where('id', $rating->id)->where('sangat_puas', 1)->first();

  //         if ($sangat_tidak_puas) {
  //             $review = "Sangat Tidak Puas";
  //         }
  //         if ($tidak_puas) {
  //             $review = "Tidak Puas";
  //         }
  //         if ($sedang) {
  //             $review = "Sedang";
  //         }
  //         if ($puas) {
  //             $review = "Puas";
  //         }
  //         if ($sangat_puas) {
  //             $review = "Sangat Puas";
  //         }


  //         $data[$key] = [
  //             'id' => $id,
  //             'employee_name' => $pegawai,
  //             'nama' => $nama,
  //             'nip' => $nip,
  //             'email' => $email,
  //             'review' => $review,
  //             'komen' => $komen,
  //             // 'sangat_tidak_puas' => $sangat_tidak_puas,
  //             // 'tidak_puas' => $tidak_puas,
  //             // 'sedang' => $sedang,
  //             // 'puas' => $puas,
  //             // 'sangat_puas' => $sangat_puas,
  //         ];
  //     }
  //     dd($data);
  //     return view('dashboard.posts.show', [
  //         'ratings' => $data
  //     ]);
  // }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Book  $book
   * @return \Illuminate\Http\Response
   */
  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Book  $book
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    // if($rating->image){
    //     Storage::delete($rating->image);
    // }

    User::destroy($user->id);

    return redirect('/dashboard/posts/employees')->with('success', 'Employee has been deleted');
  }

  // public function checkSlug(Request $request){
  //     $slug = SlugService::createSlug(Rating::class,'slug',$request->title);
  //     return response()->json(['slug' => $slug]);
  // }
}
