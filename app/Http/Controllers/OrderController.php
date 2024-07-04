<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiResponse;
use App\Models\Ingredients;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function show(Order $order, Request $request)
  {
    $orders = Order::where('id_transaksi', $order->id_transaksi)->get();
    $menu = Menu::where('id', $orders[0]->id_menu)->first();

    return view('dashboard.orders.detail', [
      'orders' => $orders,
      'menus' => $menu,
    ]);
  }

  public function index(Request $request)
  {
    $transaksi_search = $request->id_transaksi;
    $menu_search = $request->id_menu;
    $status_search = $request->status_transaksi;
    $start_date = $request->start_date;
    $end_date = $request->end_date;

    $orders = Order::query()
      ->when($transaksi_search, function ($query) use ($transaksi_search) {
        return $query->where('id_transaksi', 'like', '%' . $transaksi_search . '%');
      })
      ->when($menu_search, function ($query) use ($menu_search) {
        return $query->where('jenis', 'like', '%' . $menu_search . '%');
      })
      ->when($status_search, function ($query) use ($status_search) {
        return $query->where('status', 'like', '%' . $status_search . '%');
      })
      ->when($start_date, function ($query) use ($start_date, $end_date) {
        return $query->whereDate('created_at', '>=', $start_date)
          ->whereDate('created_at', '<=', $end_date);
      })
      ->get();
      // dd($orders);
      $menus = [];
      // dd($orders);
      if(count($orders) > 0){
        $menus = Menu::where('id', $orders[0]->id_menu)->first();
      }

    ///////////////////////////////LABA PER MENU///////////////////////////
    $dones = $orders->where('status', 'Done')->all();
    $income = 0;
    $data[] = [];
    foreach ($dones as $done) {
      $done_menu = $done->id_menu;
      $getmenu = Menu::where('id', $done_menu)->first();
      $laba = $getmenu->harga - $getmenu->nilai;
      $income = $income + $laba;
    }
    ////////////////////////////////////////////////////////////////////////
    ///////////////////////////////MENU POPULER///////////////////////////
    $all_menu = Menu::get();
    foreach ($all_menu as $key => $list_menu) {//menu paling banyak dipesan
      $count_order = Order::where('id_menu', $list_menu->id)->count();
      // dd($count_order);

      $data[$key] = [
        'nama' => $list_menu->nama,
        'jumlah' => $count_order,
      ];
    }
    // dd($data);

    ////////////////////////////////////////////////////////////////////////
    return view('dashboard.orders.index', [
      // 'orders' => $data,
      'orders' => $orders,
      'menus' => $menus,
      'income' => $income,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {

    $menus = Menu::get();

    return view('dashboard.orders.create', [
      'menus' => $menus,
    ]);
    // return view('dashboard.orders.create');
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
      'menus' => 'required|array',
      'menus.*.menu_id' => 'required',
      'menus.*.jumlah' => 'required',
      'deskripsi' => 'nullable',
    ]);

    try {
      DB::beginTransaction();

      $transaksi_id = md5(Str::random(10));
      foreach ($request->menus as $menu) {
        $thismenu = Menu::findOrFail($menu['menu_id']);
        $total = $thismenu->harga * $menu['jumlah'];

        $input = [
          'id_transaksi' => $transaksi_id,
          'id_menu' => $menu['menu_id'],
          'jumlah' => $menu['jumlah'],
          'total' => $total,
          'deskripsi' => $request->deskripsi,
          'customer_name' => $request->customer_name,
          'customer_number' => $request->customer_number,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
          'status' => "Pending",
        ];

        Order::create($input);
      }

      DB::commit();

      return redirect('/dashboard/orders/index')->with('success', 'New order has been added');
    } catch (\Exception $e) {
      DB::rollback();
      return back()->withInput()->withErrors(['error' => 'Failed to create order. Please try again.']);
    }
  }



  public function destroy(Order $order, Request $request)
  {

    $order = Order::where('id', $order->id)->first();
    // $order->delete();
    // dd($order);
    $order->update([
      "status" => "Cancelled",
      "deleted_at" => Carbon::now(),
    ]);
    return redirect('/dashboard/orders/index')->with('success', 'Order has been deleted');
  }

  public function changeStatus(Order $order, Request $request)
  {

    $transaksi = null;
    $orders = Order::findOrFail($order->id);
    if ($order->status == "Pending") {

      $orders->update([
        "status" => $request->status, //cancelled / done
      ]);
      if ($request->status == "Done") {

        $transaksi = Transaction::where('nama', $orders->id_transaksi)->first();
        if (!$transaksi) { //cek apakah transaksi tersebut memiliki beberapa pesanan sekaligus

          Transaction::create([
            'id' => $orders->id_transaksi,
            'nama' => $order->id_transaksi,
            // 'nama' => 'Transaksi' . ' ' . $order->id_transaksi,
            'created_at' => Date::now(),
            'jenis' => 'Pesanan Menu',
            'tipe' => 'Pendapatan',
            'nominal' => $orders->total,
            'biaya_tambahan' => 0,
            'deskripsi' => 'Pesanan menu Done by system',
            'status' => 'Active',
            '_author' => 'System',
          ]);
        } else {
          $transaksi->update([ //menambahkan nominal transaksi
            'nominal' => $transaksi->nominal + $orders->total,
          ]);
        }
      }
    } else {
      return redirect('/dashboard/orders/index')->with('warning', 'Hanya bisa mengubah order dengan status "Pending"');
    }


    return redirect('/dashboard/orders/index')->with('success', 'Order status changed');
  }
}
