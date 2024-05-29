<?php

namespace App\Http\Controllers\Beasiswa;

use App\Http\Controllers\Controller;
use App\Models\Beasiswa;
use Illuminate\Http\Request;

class BeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request('search')){
            $data = Beasiswa::where('task','like','%'.request('search').'%')->get();
        }else{
            $data = Beasiswa::orderBy('task', 'asc')->get();
        }
        return view("beasiswa.app", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task'=> 'required|min:3|max:30'
        ],[
            'task.required'=>'input nama wajib diisi',
            'task.min'=>'minimal memasukkan 3 karakter huruf untuk inputan nama',
            'task.max'=>'maksimal memasukkan 30 karakter huruf untuk inputan nama',
        ]);

        $data = [
            'task'=>$request->input('task')
        ];

        Beasiswa::create($data);
        return redirect()->route('beasiswa')->with('sukses','data berhasil kesimpan kedalam database');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task'=> 'required|min:3|max:30'
        ], [
            'task.required'=>'input nama wajib diisi',
            'task.min'=>'minimal memasukkan 3 karakter huruf untuk inputan nama',
            'task.max'=>'maksimal memasukkan 30 karakter huruf untuk inputan nama',
        ]);

        $data = [
            'task' =>$request->input('task'),
            'is_done' =>$request->input('is_done')
        ];

        Beasiswa::where('id', $id)->update($data);
        return redirect()->route('beasiswa')->with('success', 'Data Behasil Diperbaruhi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Beasiswa::where('id',$id)->delete();
        return redirect()->route('beasiswa')->with('success', 'Data Behasil Dihapus');
    }
}
