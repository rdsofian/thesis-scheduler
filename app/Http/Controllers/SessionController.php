<?php

namespace App\Http\Controllers;

use App\Session;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::all();
        return view("session.index", compact('sessions'));
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
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(Session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(Session $session)
    {
        //
    }

    public function import(Request $request) {
        ini_set('max_execution_time', 3600);
        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx,csv'
        ]);


        $path = $request->file('file')->getRealPath();

        $data = Excel::toArray([], $path);

        DB::beginTransaction();
        $message = "Error";
        $saved = true;
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                foreach ($value as $row) {
                    $session = new Session();

                    $date = intval($row[0]);
                    $start = $row[1];
                    $end = $row[2];


                    $session_date = Date::excelToDateTimeObject($date)->format('Y-m-d');
                    $session_start = Date::excelToDateTimeObject($start);
                    $session_end = Date::excelToDateTimeObject($end);

                    $session->date = $session_date;
                    $session->start = $session_start;
                    $session->end = $session_end;
                    $session = $saved && $session->save();
                }
            }
        }
        if ($saved) {
            DB::commit();
            return redirect()->route('session.index');
        } else {
            DB::rollBack();
            return back()->with('error', $message);
        }
    }

}
