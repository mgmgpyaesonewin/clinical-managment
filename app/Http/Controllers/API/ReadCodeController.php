<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\ReadCodesImport;
use App\ReadCode;
use App\SessionInterval;
use DB;
use Illuminate\Http\Request;
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
        return SessionInterval::join('sessions as s', 'session_intervals.session_id', 's.id')
            ->select('session_intervals.doctor_id', 's.date', 'session_intervals.id', DB::raw('COUNT(session_intervals.id) as max_slots'), 'session_intervals.booked')
            ->whereIn('session_intervals.doctor_id', [2, 3])
            ->groupBy('session_intervals.id')
            ->get()
        ;
        // ->groupBy(['date', 'doctor_id', 'max_slots'])

        // foreach ($data as $key => $value) {
        //     foreach ($value as $key => $v) {
        //         $value[$key]['count'] = count($value);
        //         $v->map(function ($value, $index) {
        //         });
        //     }
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
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
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
