<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientDoctor;
use App\Models\Poli;
use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
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
            'pcount' => PatientDoctor::where('created_at', 'LIKE', date('Y-m-d').'%')->count(),
            'rcount' => Patient::all()->count(),
            'user' => User::all(),
            'room' => Room::all(),
        );
        return view('admin.home', $data);
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
        $user = new User;
        $user->username = $request['username'];
        $user->name = $request['username'];
        $user->role_id = $request['role'];
        $user->password = Hash::make('adminpass');
        $user->is_actived = 1;
        $user->save();

        return redirect()->route('admin.users');
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
        $user = User::find($id);
        $user->username = $request['username'];
        if ($user->password != $request['password']) {
            $user->password = Hash::make($request['password']);
        }
        $user->save();

        return redirect()->route('admin.users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.users');
    }

    public function users()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'users' => User::join('roles', 'users.role_id', '=', 'roles.role_id')->get(),
            'trash' => User::onlyTrashed()->get(),
            'roles' => Role::all(),
        );
        return view('admin.users', $data);
    }

    public function restoreUser(Request $request)
    {
        User::onlyTrashed()
        ->where('user_id', $request['id'])
        ->restore();

        return redirect()->route('admin.users');
    }

    public function poli()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'poli' => Poli::all(),
            'rpoli' => Poli::onlyTrashed()->get(),
        );
        return view('admin.poli', $data);
    }

    public function doctor()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'doctor' => User::leftjoin('polis', 'polis.poli_id', '=', 'users.poli')
                            ->where('role_id', 3)->get(),
            'poli' => Poli::all(),
        );
        return view('admin.setDokter', $data);
    }

    public function setDoctor(Request $request, $id)
    {
        $doc = User::find($id);
        $doc->poli = $request['poli'];
        $doc->save();

        return redirect()->route('admin.doctor');
    }

    public function unsetDoctor($id)
    {
        $doc = User::find($id);
        $doc->poli = NULL;
        $doc->save();

        return redirect()->route('admin.doctor');
    }

    public function changePassword(Request $request)
    {
        $user = User::find(Auth::user()->user_id);
        $user->password = Hash::make($request['password']);
        $user->save();
        Auth::logout();

        return redirect('/');
    }

    public function addPoli(Request $request)
    {
        $poli = new Poli;
        $poli->poli_name = $request['poli_name'];
        $poli->save();

        return redirect()->route('admin.poli');
    }

    public function deletePoli($id)
    {
        $poli = Poli::find($id);
        $poli->delete();

        return redirect()->route('admin.poli');
    }

    public function restorePoli(Request $request)
    {
        Poli::onlyTrashed()
        ->where('poli_id', $request['id'])
        ->restore();
        return redirect()->route('admin.poli');
    }

    public function restoreAllPoli()
    {
        Poli::withTrashed()
        ->restore();
        return redirect()->route('admin.poli');
    }

    public function room()
    {
        $data = array(
            'role' => Role::find(Auth::user()->role_id),
            'room' => Room::all(),
            'rroom' => Room::onlyTrashed()->get(),
        );
        return view('admin.room', $data);
    }

    public function addRoom(Request $request)
    {
        $room = new Room;
        $room->room_name = $request['name'];
        $room->room_class = $request['class'];
        $room->room_capacity = (int)$request['class'] + 1;
        $room->room_status = 'kosong';
        $room->room_price = $request['price'];
        $room->save();

        return redirect()->route('admin.room');
    }

    public function deleteRoom($id)
    {
        $room = Room::find($id);
        $room->delete();

        return redirect()->route('admin.room');
    }

    public function restoreRoom(Request $request)
    {
        Room::withTrashed()
        ->where('room_id', $request['id'])
        ->restore();
        return redirect()->route('admin.room');
    }

    public function restoreAllRoom()
    {
        Room::withTrashed()
        ->restore();
        return redirect()->route('admin.room');
    }

    public function editRoom(Request $request, $id)
    {
        $room = Room::find($id);
        $room->room_name = $request['room_name'];
        $room->room_class = $request['room_class'];
        $room->room_price = $request['room_price'];
        $room->save();

        return redirect()->route('admin.room');
    }

    public function test($date)
    {
        $label = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        for ($i=0; $i < 12 ; $i++) {
            if ($i < 9) {
                $d = "0".(string)$i+1;
            } else {
                $d = (string)($i+1);
            }
            $count[$i] = PatientDoctor::where('created_at', 'LIKE', $date.'-'.$d.'%')->count();
            $p[$i] = $d;
        }
        return response()->json([
            'label' => $label,
            'count' => $count,
        ]);
    }
}
