<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\MedicRecord;
use App\Models\Patient;
use App\Models\PatientBill;
use App\Models\Role;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PharmacyController extends Controller
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
            'medrec' => PatientBill::join('medic_records', 'medic_records.medrec_id', '=', 'patient_bills.medrec_id')
                                    ->join('patients', 'patients.patient_id', '=', 'medic_records.patient_id')
                                    ->join('users', 'users.user_id', '=', 'medic_records.user_id')
                                    ->where('patient_bills.created_at', 'LIKE', date('Y-m-d').'%')
                                    ->groupBy('patient_bills.medrec_id')
                                    ->get(),
        );
        return view('pharmacy.home', $data);
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
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'bill' => PatientBill::join('medicines', 'medicines.batch_id', '=', 'patient_bills.medicine_id')
                                ->join('medicine_types', 'medicine_types.type_id', '=', 'medicines.type_id')
                                ->where('medrec_id', $id)
                                ->get(),
            'patient' => MedicRecord::join('patients', 'patients.patient_id', '=', 'medic_records.patient_id')
                                    ->where('medrec_id', $id)
                                    ->first(),
        );
        return view('pharmacy.check', $data);
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

    public function changePassword(Request $request)
    {
        $user = User::find(Auth::user()->user_id);
        $user->password = Hash::make($request['password']);
        $user->save();

        Auth::logout();
        return redirect('/');
    }

    public function listObat()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'medicine' => Medicine::join('medicine_types', 'medicine_types.type_id', '=', 'medicines.type_id')->get(),
        );
        return view('pharmacy.list', $data);
    }

    public function cetak(Request $request, $medrec)
    {
        $medrec1 = MedicRecord::find($medrec);
        foreach ($request->moreField as $key => $value) {
            DB::table('patient_bills')
                ->where("medrec_id", $medrec)
                ->where('medicine_id', $value['check'])
                ->update(array("status"=>'ada'));
        }
        $outpatient = DB::table('outpatients')->where('medrec_id', $medrec1['medrec_id'])->first();

        $data = array(
            'bill' => PatientBill::join('medicines', 'medicines.batch_id', '=', 'patient_bills.medicine_id')
                                    ->join('medicine_types', 'medicine_types.type_id', '=', 'medicines.type_id')
                                    ->where('medrec_id', $medrec)
                                    ->where('status', 'ada')->get(),
            'patient' => Patient::find($medrec1['patient_id']),
            'doc' => User::find($medrec1['user_id']),
            'medrec' => $medrec1,
            'outpatient' => $outpatient->service_price,
            'total' => 0,
        );
        $print = \PDF::loadview('pharmacy.print', $data);
        return $print->stream();
    }
}
