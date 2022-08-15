<?php

namespace App\Http\Controllers;

use App\Lecturer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lecturers = Lecturer::all();
        return view("lecturer.index", compact('lecturers'));
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
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function show(Lecturer $lecturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecturer $lecturer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecturer $lecturer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecturer $lecturer)
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
                    $lecturer = new Lecturer();

                    $lecturer->code = $row[0];
                    $lecturer->name = $row[1];
                    $lecturer = $saved && $lecturer->save();
                }
            }
        }
        if ($saved) {
            DB::commit();
            return redirect()->route('lecturer.index');
        } else {
            DB::rollBack();
            return back()->with('error', $message);
        }
    }
}
