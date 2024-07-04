<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Menu;
use App\Models\Special;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $menus = Menu::get();
        // $specials = Special::get();


        return view('index', [
            // 'menus' => $menus,
            // 'specials' => $specials,
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
