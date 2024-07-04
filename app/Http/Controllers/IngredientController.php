<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name_search = $request->nama;
        $kategori_search = $request->kategori;

        $ingredients = Ingredients::query()
            ->when($name_search, function ($query) use ($name_search) {
                return $query->where('nama', 'like', '%' . $name_search . '%');
            })
            ->when($kategori_search, function ($query) use ($kategori_search) {
                return $query->where('kategori', 'like', '%' . $kategori_search . '%');
            })
            ->get();

        $data = [];

        foreach ($ingredients as $ingredient) {

            $data[] = [
                'id' => $ingredient->id,
                'nama' => $ingredient->nama,
                'nilai' => $ingredient->nilai,
                'satuan' => $ingredient->satuan,
                'deskripsi' => $ingredient->deskripsi,
                'kategori' => $ingredient->kategori,
                'time' => Date::now(),
            ];
        }

        return view('dashboard.ingredients.index', [
            // 'ingredients' => $data,
            'ingredients' => $ingredients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('dashboard.ingredients.create');
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
            'nilai' => 'required',
            'satuan' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'nullable',
        ]);

        $input = $request->all();

        Ingredients::create($input);

        return redirect('/dashboard/ingredients/index')->with('success', 'New ingredient has been added');
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
    public function edit(Ingredients $ingredient)
    {
        return view('dashboard.ingredients.edit', [
            'ingredient' => $ingredient,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredients $ingredient)
    {
        $ingredientData = [
            'nama' => 'required',
            'nilai' => 'required',
            'satuan' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'nullable',
        ];


        $validatedData = $request->validate($ingredientData);


        Ingredients::where('id', $ingredient->id)->update($validatedData);
        // Ingredients::where('id',$request->id)->update($validatedData);

        return redirect('/dashboard/ingredients/index')->with('success', 'Ingredients has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredients $ingredient)
    {
        Ingredients::destroy($ingredient->id);

        return redirect('/dashboard/ingredients/index')->with('success', 'Ingredient has been deleted');
    }
}
