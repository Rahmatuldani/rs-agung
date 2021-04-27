<?php

namespace App\Http\Controllers;

use App\Models\Inpatient;
use App\Models\Patient;
use App\Models\PatientBill;
use App\Models\PatientDoctor;
use App\Models\Poli;
use App\Models\Role;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceptionistController extends Controller
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
            'patient' => PatientDoctor::join('patients', 'patients.patient_id', '=', 'patient_doctors.patient_id')
                                        ->join('polis', 'polis.poli_id', '=', 'patient_doctors.poli_id')
                                        ->where('patient_doctors.created_at', 'LIKE', date('Y-m-d').'%')
                                        ->get(),
        );
        return view('receptionist.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
        );
        return view('receptionist.addPatient', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_name' => 'required',
            'patient_sex' => 'required',
            'patient_birth' => 'required',
            'paid_status' => 'required',
            'patient_job' => 'required',
            'patient_partner' => 'required',
            'patient_address' => 'required',
            'patient_phone' => 'required',
            'blood_type' => 'required',
            'religion' => 'required',
        ]);

        $patient = new Patient;
        $patient->patient_name = $request['patient_name'];
        $patient->patient_sex = $request['patient_sex'];
        $patient->patient_birth = $request['patient_birth'];
        $patient->paid_status = $request['paid_status'];
        $patient->patient_job = $request['patient_job'];
        $patient->patient_partner = $request['patient_partner'];
        $patient->patient_address = $request['patient_address'];
        $patient->patient_phone = $request['patient_phone'];
        $patient->blood_type = $request['blood_type'];
        $patient->religion = $request['religion'];
        $patient->save();

        return redirect()->route('receptionist.patient')->with('message', 'Data pasien berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'p' => Patient::find($id),
        );
        return view('receptionist.showPatient', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'p' => Patient::find($id),
        );
        return view('receptionist.editPatient', $data);
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
        $validated = $request->validate([
            'patient_name' => 'required',
            'patient_sex' => 'required',
            'patient_birth' => 'required',
            'paid_status' => 'required',
            'patient_job' => 'required',
            'patient_partner' => 'required',
            'patient_address' => 'required',
            'patient_phone' => 'required',
            'blood_type' => 'required',
            'religion' => 'required',
        ]);

        $patient = Patient::find($id);
        $patient->patient_name = $request['patient_name'];
        $patient->patient_sex = $request['patient_sex'];
        $patient->patient_birth = $request['patient_birth'];
        $patient->paid_status = $request['paid_status'];
        $patient->patient_job = $request['patient_job'];
        $patient->patient_partner = $request['patient_partner'];
        $patient->patient_address = $request['patient_address'];
        $patient->patient_phone = $request['patient_phone'];
        $patient->blood_type = $request['blood_type'];
        $patient->religion = $request['religion'];
        $patient->save();

        return redirect()->route('receptionist.patient')->with('message', 'Data pasien berhasil diupdate');
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

    public function patient()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'patient' => Patient::all(),
            'poli' => Poli::all(),
        );
        return view('receptionist.patient', $data);
    }

    public function patient_poli(Request $request, $id)
    {
        $pp = new PatientDoctor;
        $pp->patient_id = $id;
        $pp->poli_id = $request['poli'];
        $pp->status = 'Menunggu pemeriksaan';
        $pp->save();

        return redirect()->route('receptionist.patient')->with('message', 'Data pasien berhasil masuk');
    }

    public function room()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'room' => Room::withoutTrashed()->get(),
            'inpatient' => Inpatient::join('patients', 'patients.patient_id', '=', 'inpatients.patient_id')
                                    ->where('room_id', null)
                                    ->get(),
        );
        return view('receptionist.room', $data);
    }

    public function dRoom(Request $request, $id)
    {
        $in = Inpatient::find($request['patient_id']);
        $in->room_id = $id;
        $in->save();
        $in = $in->room;
        $in->room_capacity = $in->room_capacity-1;
        if ($in->room_capacity == 0) {
            $in->room_status = 'Penuh';
        }
        $in->save();

        return redirect()->route('receptionist.room')->with('message', 'Data pasien berhasil masuk');
    }

    public function cetak($patient)
    {
        $data = array(
            'patient' => Patient::find($patient),
        );

        $print = \PDF::loadview('receptionist.print', $data);
        return $print->stream();
    }
}
