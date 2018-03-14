<?php

namespace App\Http\Controllers;

use App\Record;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $endDate = Carbon::now()->addDay();
        /*For productoin make start date 7 days earlier than now() by subDays(7)*/
        $startDate = Carbon::now()->subMonth();
        $reports = Record::whereBetween('created_at', [$startDate, $endDate])->get();
        return view('reports.report',compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function search(Request $request){
        $this->validate($request,[
            'menu_type' => 'required',
            'startDate' => 'required|date',
            'endDate' => 'required|date'
        ]);
        $input = $request->all();
        $startDate = Carbon::parse($input['startDate']);
        $endDate = Carbon::parse($input['endDate'])->addDay();
        $reports = Record::whereBetween('created_at', [$startDate, $endDate])->get();
        return view('reports.report',compact('reports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }
}
