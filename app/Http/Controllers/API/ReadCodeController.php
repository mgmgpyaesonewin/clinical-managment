<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ReadCodesImport;
use App\ReadCode;
use Maatwebsite\Excel\Facades\Excel;

class ReadCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        return ReadCode::search($req->key)->get();
        // return ReadCode::where('code','like',"%$req->key%")
        // ->orWhere('title','like',"%$req->key%")
        // ->select('code','title')->get();
    }    

    public function search(Request $req)
    {
        return ReadCode::search($req->key);
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
        $file = $request->file('excel');
        // dd($file);
        Excel::import(new ReadCodesImport(), $file);
        return $file;
        // return response()->json(['success' => 'done'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
