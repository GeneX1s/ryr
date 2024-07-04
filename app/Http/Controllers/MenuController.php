<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiResponse;
use App\Models\Ingredients;
use Illuminate\Support\Facades\Hash;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function show(Menu $menu, Ingredients $ingredients)
    {
        // dd($menu->id);
        $ingredients = Ingredients::get();
        return view('dashboard.menus.group_edit', [
            'menu' => $menu,
            'ingredients' => $ingredients,
        ]);
    }

    public function index_bahan(Menu $menu, Ingredients $ingredients)
    {
        // dd($menu->id);
        $ingredients = Ingredients::get();
        $menus_group = DB::table('menus_group')->get();
        $data = null;
        foreach ($menus_group as $key => $resep) {

            $bahan = $ingredients->where('id', $resep->ingredient_id)->first()->nama;
            $data[$key] = [
                'Id' => $resep->id,
                'Bahan' => $bahan,
                'Jumlah' => $resep->amount,
            ];
        }
        // dd($data);
        return view('dashboard.menus.group_index', [
            'menu' => $menu,
            'ingredients' => $ingredients,
            'resep' => $data,
        ]);
    }

    public function menuGroup(Menu $menu, Ingredients $ingredients, Request $request)
    {
        $request->validate([
            'ingredients' => 'required|array',
            'ingredients.*.ingredient_id' => 'required',
            'ingredients.*.amount' => 'required',
        ]);

        foreach ($request->ingredients as $ingredient) {
            $input = [
                'menu_id' => $menu->id,
                'ingredient_id' => $ingredient['ingredient_id'],
                'amount' => $ingredient['amount'],
            ];

            // Assuming 'menus_group' is an Eloquent model
            DB::table('menus_group')->insert($input);
            // MenusGroup::create($input);
        }

        return redirect('/dashboard/menus/index')->with('success', 'Ingredients have been updated');
    }

    public function index(Request $request)
    {
        $name_search = $request->name;
        $kategori_search = $request->kategori_1;

        $menus = Menu::query()
            ->when($name_search, function ($query) use ($name_search) {
                return $query->where('nama', 'like', '%' . $name_search . '%');
            })
            ->when($kategori_search, function ($query) use ($kategori_search) {
                return $query->where('kategori_1', 'like', '%' . $kategori_search . '%');
            })
            ->get();

        $data = [];

        foreach ($menus as $menu) {
            $group = DB::table('menus_group')->where('menu_id', $menu->id)->get(); //banyak
            $bahan = "-";
            $nilai = [];
            $ingredient = [];
            $total = 0;
            foreach ($group as $key => $bahan) {
                // $total = 0;
                $ingredients = Ingredients::where('id', $bahan->ingredient_id)->first();
                $total = $total + ($bahan->amount * $ingredients->nilai);

                $ingredient[$key] = [
                    'bahan' => $ingredients->nama,
                ];
                // $nilai[$key] = [
                //     'nilai' => $total,
                // ];
            }

            $data[] = [
                'id' => $menu->id,
                'nama' => $menu->nama,
                // 'bahan' => $ingredient,
                'nilai' => $total,
                'harga' => $menu->harga,
                'deskripsi' => $menu->deskripsi,
                'foto' => $menu->foto,
                'kategori_1' => $menu->kategori_1,
                'kategori_2' => $menu->kategori_2,
                'time' => $menu->_timestamp,
            ];
        }

        // dd($data);
        return view('dashboard.menus.index', [
            'menus' => $data,
            // 'menus' => $menus,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        return view('dashboard.menus.create');
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
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'kategori_1' => 'nullable',
            'kategori_2' => 'nullable',
            'foto' => 'image|file',
            'ingredients' => 'nullable',
        ]);

        $input = $request->all();

        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto');
            $imageName = 'assets/img/menu/' . $imagePath->getClientOriginalName();


            $imagePath->move(public_path('assets/img/menu'), $imageName);
            // $imagePath->move('public/assets/img/menu',$imageName);
            $input['foto'] = $imageName;
        } else {
            // Handle case where no file is uploaded
            $input['foto'] = null; // Or any default value you want
        }

        Menu::create($input);

        return redirect('/dashboard/menus/index')->with('success', 'New menu has been added');
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
    public function edit(Menu $menu)
    {
        return view('dashboard.menus.edit', [
            'menu' => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menuData = [
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'kategori_1' => 'nullable',
            'kategori_2' => 'nullable',
            'foto' => 'image|file',
            'ingredients' => 'nullable',
        ];


        $validatedData = $request->validate($menuData);

        if ($request->hasFile('foto')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $imagePath = $request->file('foto');
            $imageName = 'assets/img/menu/' . $imagePath->getClientOriginalName();


            $imagePath->move(public_path('assets/img/menu'), $imageName);
            $validatedData['foto'] = $imageName;
        } else {
            $validatedData['foto'] = null;
        }

        Menu::where('id', $menu->id)->update($validatedData);
        // Menu::where('id',$request->id)->update($validatedData);

        return redirect('/dashboard/menus/index')->with('success', 'Menu has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if ($menu->foto) {
            Storage::delete($menu->foto);
        }

        DB::table("menus_group")->where('menu_id', $menu->id)->delete();

        Menu::destroy($menu->id);

        return redirect('/dashboard/menus/index')->with('success', 'Menu has been deleted');
    }

    public function deleteGroup(Request $request, Menu $menu)
    {

        // dd($request->id);
        $id = DB::table("menus_group")->where('id', $request->id)->first()->menu_id;
        DB::table("menus_group")->where('id', $request->id)->delete();

        return redirect('/dashboard/ingredientmenus/' . $id . '/show')->with('success', 'Ingredient has been deleted');
    }

    public function uploadImage($file)
    {
        // Validate the uploaded file
        if (!$file->isValid()) {
            return response()->json(['error' => 'Invalid file'], 400);
        }

        // Define the destination directory
        $destinationPath = 'public/assets/img/menu';

        // Store the file in the specified directory
        $path = $file->store($destinationPath);

        // Return the path where the file is stored
        return $path;
    }
}
