<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Models\LogReport;
use App\Models\Medicine;
use App\Models\MedicineType;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogisticController extends Controller
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
            'medicine' => Medicine::join('medicine_types', 'medicine_types.type_id', '=', 'medicines.type_id')->get(),
            'type' => MedicineType::all(),
        );
        return view('logistic.home', $data);
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
            'type' => MedicineType::all(),
        );
        return view('logistic.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->medicine as $key => $value) {
            $medicine = new Medicine;
            $medicine->batch_id = strtoupper($value['batch']);
            $medicine->type_id = $value['type'];
            $medicine->medicine_name = $value['name'];
            $medicine->medicine_stock = 0;
            $medicine->medicine_price = $value['price'];
            $medicine->save();
        }
        return redirect()->route('logistic.index');
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
        $dist = Distributor::find($id);
        $dist->npwp = $request['npwp'];
        $dist->distributor_name = $request['name'];
        $dist->distributor_address = $request['address'];
        $dist->distributor_phone = $request['phone'];
        $dist->save();

        return redirect()->route('log.vdistributor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicine = Medicine::find($id);
        $medicine->delete();

        return redirect()->route('logistic.index');
    }

    public function report()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'report' => LogReport::join('users', 'users.user_id', '=', 'log_reports.user_id')
                                    ->leftjoin('distributors', 'distributors.distributor_id', '=', 'log_reports.distributor_id')
                                    ->groupBy('fracture_id')
                                    ->get(),
        );
        return view('logistic.report', $data);
    }

    public function vReport()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'type' => MedicineType::all(),
            'medicine' => Medicine::all(),
            'dist' => Distributor::all(),
        );
        return view('logistic.vreport', $data);
    }

    public function addReport(Request $request)
    {
        $dist = Distributor::where('distributor_name', $request['dist'])->first();

        foreach ($request->medicine as $key => $value) {
            $med = Medicine::where('medicine_name', $value['name'])->first();

            $report = new LogReport;
            $report->user_id = Auth::user()->user_id;
            if ($request['fracture_id'] != null) {
                $report->fracture_id = strtoupper($request['fracture_id']);
            } else {
                $report->fracture_id = 'OUT'.date('ymdHsi');
            }
            $report->type = $request['type'];
            $report->distributor_id = $dist['distributor_id'];
            $report->medicine_id = $med['batch_id'];
            $report->first_stock = $med['medicine_stock'];
            $report->last_stock = $value['amount'];
            $report->description = $value['description'];
            $report->save();

            if ($request['type'] == 'in') {
                $med->medicine_stock = $med->medicine_stock+$value['amount'];
            } else {
                $med->medicine_stock = $med->medicine_stock-$value['amount'];
            }
            $med->save();
        }

        return redirect()->route('log.report');
    }

    public function type()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'type' => MedicineType::all(),
        );
        return view('logistic.type', $data);
    }

    public function addType(Request $request)
    {
        $type = new MedicineType;
        $type->type_name = $request['name'];
        $type->save();

        return redirect()->route('log.type');
    }

    public function typeDelete($id)
    {
        $type = MedicineType::find($id);
        $type->delete();

        return redirect()->route('log.type');
    }

    public function listReport($fracture, $name, $dist)
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'fracture' => $fracture,
            'name' => $name,
            'dist' => $dist,
            'log' => LogReport::join('medicines', 'medicines.batch_id', '=', 'log_reports.medicine_id')
                                ->where('fracture_id', $fracture)->get(),
        );
        return view('logistic.list', $data);
    }

    public function distributor()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
        );
        return view('logistic.distributor', $data);
    }

    public function vdistributor()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'dist' => Distributor::all(),
        );
        return view('logistic.vdist', $data);
    }

    public function pDistributor(Request $request)
    {
        foreach ($request->dist as $key => $value) {
            $dist = new Distributor;
            $dist->npwp = $value['npwp'];
            $dist->distributor_name = $value['name'];
            $dist->distributor_address = $value['address'];
            $dist->distributor_phone = $value['phone'];
            $dist->save();
        }

        return redirect()->route('log.vdistributor');
    }

    public function destroyDist($id)
    {
        $dist = Distributor::find($id);
        $dist->delete();

        return redirect()->route('log.vdistributor');
    }
}
