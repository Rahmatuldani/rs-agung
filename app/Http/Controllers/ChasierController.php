<?php

namespace App\Http\Controllers;

use App\Models\Inpatient;
use App\Models\Outpatient;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChasierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
        );
        return view('chasier.home', $data);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    public function inpatient()
    {
        $dawal = date('Y-m-01');
        $dakhir = date('Y-m-t');
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'inpatient' => Inpatient::join('users', 'users.user_id', '=', 'inpatients.user_id')
                                        ->join('patients', 'patients.patient_id', '=', 'inpatients.patient_id')
                                        ->join('rooms', 'rooms.room_id', '=' ,'inpatients.room_id')
                                        ->whereBetween('inpatients.created_at', [$dawal.'%', $dakhir.'%'])
                                        ->get(),
        );
        return view('chasier.inpatient', $data);
    }

    public function outpatient()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'outpatient' => Outpatient::join('users', 'users.user_id', '=', 'outpatients.user_id')
                                        ->join('patients', 'patients.patient_id', '=', 'outpatients.patient_id')
                                        ->where('outpatients.created_at', 'LIKE', date('Y-m-d').'%')
                                        ->get(),
        );
        return view('chasier.outpatient', $data);
    }

    public function pInpatient($id)
    {
        $in = Inpatient::find($id);
        $in->status = 'lunas';
        $in->save();

        return redirect()->route('chas.inpatient');
    }

    public function pOutpatient($id)
    {
        $in = Outpatient::find($id);
        $in->status = 'lunas';
        $in->save();

        return redirect()->route('chas.outpatient');
    }
}
