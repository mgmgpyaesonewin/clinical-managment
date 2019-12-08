<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\ReadCodesImport;
use App\ReadCode;
use App\SessionInterval;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use function PHPSTORM_META\map;

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
    //    return $req->all();
     $data=SessionInterval::join('sessions as s','s.id','session_intervals.session_id')
                            ->whereIn('s.doctor_id',$req->id)
                            ->whereDate('s.date','>=',$req->fromdate)
                            ->whereDate('s.date','<=',$req->todate)
                            ->select('s.*','session_intervals.id',
                            'session_intervals.booked')
                            ->with('doctor')
                            ->get()
                            ->groupBy(['date', 'doctor_id',])->toArray();
    return $data;
    // $newarray=array();
    // foreach ($data as $key => $value) {
    //    foreach ($value as $k => $v) {
    //         $count =0;
    //         $doctor=null;
    //       foreach ($v as $lkey => $la) {
    //         if($la['booked']){
    //             $count++;
    //         }
    //         $doctor=$la->doctor;
    //       }
    //       $newarray[$key][$k]=['count'=>$count,'maxcount'=>count($v),'doctor'=>$doctor];
    //       $count=0;
    //       $doctor=null;
    //    }
    // }  
    // return $newarray;
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
