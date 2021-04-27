<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicineType;
use App\Models\MedicRecord;
use App\Models\Patient;
use App\Models\PatientBill;
use App\Models\PatientDoctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'user' => User::join('polis', 'polis.poli_id', '=', 'users.poli')
                            ->where('user_id', Auth::user()->user_id)
                            ->first(),
            'patient' => PatientDoctor::join('patients', 'patients.patient_id', '=', 'patient_doctors.patient_id')
                                        ->where('poli_id', Auth::user()->poli)
                                        ->where('patient_doctors.created_at', 'LIKE', date('Y-m-d%'))
                                        ->where('status', "Menunggu pemeriksaan")
                                        ->get(),
            'medicine' => null,
        );
        return view('doctor.home', $data);
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
    public function store(Request $request, $id, $medrec)
    {
        foreach ($request->moreFields as $key => $value) {
            $medicine = Medicine::where('medicine_name', $value['medicine'])->first();
            $bill = new PatientBill;
            $bill->medrec_id = $medrec;
            $bill->medicine_id = $medicine['batch_id'];
            $bill->amount = $value['amount'];
            $bill->subtotal = $medicine['medicine_price']*$value['amount'];
            $bill->save();
        }
        return redirect()->route('doctor.index');
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

    public function examPatient($id)
    {
        $data = array(
            'user' => User::join('polis', 'polis.poli_id', '=', 'users.poli')
                            ->where('user_id', Auth::user()->user_id)
                            ->first(),
            'patient' => Patient::find($id),
            'unit' => MedicineType::all(),
            'medicine' => Medicine::all(),
        );

        return view('doctor.exam', $data);
    }

    public function medrec(Request $request, $id, $name)
    {
        $medrec_id = strtoupper(substr($name, 0, 4)).date('ymdHsi');
        $medrec = new MedicRecord;
        $medrec->medrec_id = $medrec_id;
        $medrec->patient_id = $id;
        $medrec->user_id = Auth::user()->user_id;
        $medrec->complaint =  $request['complaint'];
        $medrec->action = $request['action'];
        $medrec->status = $request['stats'];
        $medrec->save();

        if ($request['stats'] == 'Rawat Jalan') {
            $patient = DB::update('update patient_doctors set status="Menunggu pembayaran" where patient_id = ?', [$id]);
            DB::table('outpatients')->insert([
                'user_id' => Auth::user()->user_id,
                'medrec_id' => $medrec_id,
                'patient_id' => $id,
                'service_price' => 50000,
                'status' => 'belum lunas',
            ]);
        } else {
            $patient = DB::update('update patient_doctors set status="Rawat inap" where patient_id = ?', [$id]);
            DB::table('inpatients')->insert([
                'user_id' => Auth::user()->user_id,
                'medrec_id' => $medrec_id,
                'patient_id' => $id,
                'service_price' => 50000,
                'status' => 'belum lunas',
            ]);
        }

        return redirect()->route('doc.obat', [$id, $medrec_id]);
    }

    public function obat($id, $medrec)
    {
        $data = array(
            'user' => User::join('polis', 'polis.poli_id', '=', 'users.poli')
                            ->where('user_id', Auth::user()->user_id)
                            ->first(),
            'patient' => Patient::find($id),
            'medicine' => Medicine::all(),
        );
        return view('doctor.obat', $data);
    }
}
