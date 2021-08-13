<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReportDocumentRequest;
use App\Repositories\Frontend\ProblemRepository;
use Illuminate\Http\Request;
use App\Repositories\Frontend\ReportDocumentRepository;
class ReportDocumentController extends Controller
{

    public $repo;

    public function __construct(ReportDocumentRepository $repo)
    {
        $this->repo=$repo;
    }
    public function index()
    {
        return $this->repo->latest()->first();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportDocumentRequest $request)
    {
        // dd($request);
        return  $this->repo->create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReportDocumentRequest $request, $id)
    {
        // dd($request);
        return $this->repo->updateById($id,$request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $this->repo->where('id',$id)->first();
        return (string)$this->repo->getById($id)->delete();
    }
}
