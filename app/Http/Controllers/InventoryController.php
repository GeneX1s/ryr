<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

class InventoryController extends Controller
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

        $inventories = Inventory::query()
            ->when($name_search, function ($query) use ($name_search) {
                return $query->where('nama', 'like', '%' . $name_search . '%');
            })
            ->when($kategori_search, function ($query) use ($kategori_search) {
                return $query->where('kategori', 'like', '%' . $kategori_search . '%');
            })
            ->get();

        $data = [];

        foreach ($inventories as $inventory) {

            $data[] = [
                'id' => $inventory->id,
                'nama' => $inventory->nama,
                'nilai' => $inventory->nilai,
                'satuan' => $inventory->satuan,
                'deskripsi' => $inventory->deskripsi,
                'kategori' => $inventory->kategori,
                'time' => Date::now(),
            ];
        }

        return view('dashboard.inventories.index', [
            // 'inventories' => $data,
            'inventories' => $inventories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('dashboard.inventories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'id_grup' => 'required',
            'nama' => 'required',
            'jumlah' => 'required',
            'nilai' => 'required',
            'satuan' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'nullable',
            'kategori' => 'nullable',
            ]);
            
        $input = $request->all();

        Inventory::create($input);

        return redirect('/dashboard/inventories/index')->with('success', 'New inventory has been added');
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
    public function edit(Inventory $inventory)
    {
        return view('dashboard.inventories.edit', [
            'inventory' => $inventory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $ingredientData = [
            'nama' => 'required',
            'nilai' => 'required',
            'satuan' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'nullable',
        ];


        $validatedData = $request->validate($ingredientData);


        Inventory::where('id', $inventory->id)->update($validatedData);
        // Inventory::where('id',$request->id)->update($validatedData);

        return redirect('/dashboard/inventories/index')->with('success', 'Inventory has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        Inventory::destroy($inventory->id);

        return redirect('/dashboard/inventories/index')->with('success', 'Inventory has been deleted');
    }
}
