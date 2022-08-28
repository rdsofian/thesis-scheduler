<?php

namespace App\Http\Controllers;

use App\ReportTemporary;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ReportTemporaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temporaries = ReportTemporary::all();
        return view('temporary.index', compact('temporaries'));
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
     * @param  \App\ReportTemporary  $reportTemporary
     * @return \Illuminate\Http\Response
     */
    public function show(ReportTemporary $reportTemporary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReportTemporary  $reportTemporary
     * @return \Illuminate\Http\Response
     */
    public function edit(ReportTemporary $reportTemporary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReportTemporary  $reportTemporary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportTemporary $reportTemporary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReportTemporary  $reportTemporary
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportTemporary $reportTemporary)
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
                    $temporary = new ReportTemporary();

                    $date = intval($row[1]);
                    $time = $row[2];

                    $session_date = Date::excelToDateTimeObject($date)->format('Y-m-d');
                    $session_time = Date::excelToDateTimeObject($time);

                    $temporary->day_name = $row[0];
                    $temporary->date = $session_date;
                    $temporary->time = $session_time;
                    $temporary->room = $row[3];
                    $temporary->code =$row[4];
                    $temporary->name =$row[5];
                    $temporary->faculty =$row[6];
                    $temporary->lecturer =$row[7];
                    $temporary->chairman =$row[8];
                    $temporary->vice_chairman =$row[9];
                    $temporary = $saved && $temporary->save();
                }
            }
        }
        if ($saved) {
            DB::commit();
            return redirect()->route('temporary.index');
        } else {
            DB::rollBack();
            return back()->with('error', $message);
        }
    }
}
