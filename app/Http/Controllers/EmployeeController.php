<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name_search = $request->name;
        $jabatan_search = $request->jabatan;

        $employees = Employee::query()
            ->when($name_search, function ($query) use ($name_search) {
                return $query->where('name', 'like', '%' . $name_search . '%');
            })
            ->when($jabatan_search, function ($query) use ($jabatan_search) {
                return $query->where('jabatan', 'like', '%' . $jabatan_search . '%');
            })
            ->get();

        $data = [];

        foreach ($employees as $employee) {

            $data[] = [
                'id' => $employee->id,
                'name' => $employee->name,
                'nilai' => $employee->nilai,
                'satuan' => $employee->satuan,
                'deskripsi' => $employee->deskripsi,
                'kategori' => $employee->kategori,
                'time' => Date::now(),
            ];
        }

        return view('dashboard.employees.index', [
            // 'employees' => $data,
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view('dashboard.employees.create');
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
            'name' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'role' => 'required',
            'gaji' => 'required',
            'kpi' => 'nullable',
            'email' => 'nullable',
            'nik' => 'required',
        ]);

        $input = $request->all();

        Employee::create($input);

        return redirect('/dashboard/employees/index')->with('success', 'New employee has been added');
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
    public function edit(Employee $employee)
    {
        return view('dashboard.employees.edit', [
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $ingredientData = [
            'name' => 'required',
            'nilai' => 'required',
            'satuan' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'nullable',
        ];


        $validatedData = $request->validate($ingredientData);


        Employee::where('id', $employee->id)->update($validatedData);
        // Employee::where('id',$request->id)->update($validatedData);

        return redirect('/dashboard/employees/index')->with('success', 'Employee has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Employee::destroy($employee->id);

        return redirect('/dashboard/employees/index')->with('success', 'Employee has been deleted');
    }
}
