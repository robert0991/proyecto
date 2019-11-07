<?php

namespace App\Http\Controllers;

use App\Vacation;
use App\Permit;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class PermitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create($id_worker,$name_worker)
    {
        try {
            $decrypted_id = \Crypt::decrypt($id_worker);
            $decrypted_name = \Crypt::decrypt($name_worker);
        } catch (DecryptException $e) {
            return redirect('/home');
        }
        return view('permit.create')->with('id_worker',$decrypted_id)->with('name_worker',$decrypted_name);
    }
    public function create1($id_worker,$name_worker)
    {
        try {
            $decrypted_id = \Crypt::decrypt($id_worker);
            $decrypted_name = \Crypt::decrypt($name_worker);
        } catch (DecryptException $e) {
            return redirect('/home');
        }
        $now = carbon::now();
        return view('permit.create1')->with('id_worker',$decrypted_id)
                                     ->with('name_worker',$decrypted_name)
                                    ;
    }

    public function store(Request $request)
    {
       $this->validate($request, [
            'type' => 'required',
            'days_taken' => 'required',
            'reason' => 'required',
            'observations' => 'required',
            'date_init' => 'required',
            'worker_id' => 'required',
        ]);
        
        $permit = new Permit();
        $permit->type = $request['type'];
        $permit->days_taken = $request['days_taken'];
        $permit->reason = $request['reason'];
        $permit->observations = $request['observations'];
        $permit->date_init = date("Y-m-d", strtotime($request['date_init']));
        $permit->worker_id = $request['worker_id'];

        $permit->save();

        return redirect('/home');
        /* los datos de permiso no pueden ser guardados porque el modelo Permit  no tiene tabla*/
        /*$datosEmpleado = request()-> all();
        return response()->json($datosEmpleado);*/
    }
    public function store1(Request $request)
    {
        /*$datosPermiso = request()-> all();
        return response()->json($datosPermiso);*/
        $this->validate($request, [
            'type' => 'required',
            'reason' => 'required',
            'hours_permit' => 'required',
            'observations' => 'required',
            'date_init' => 'required',
            'worker_id' => 'required',
        ]);
        $hora = $request['hours_permit'];
        list($horas, $minutos) = explode(':', $hora);
        $hora_en_segundos = ($horas * 3600 ) + ($minutos * 60 );
        
        $permit = new Permit();
        $permit->type = $request['type'];
        /*$permit->days_taken = 0 ;*/
        $permit->permit_hours = $request['hours_permit'];
        $permit->hour_in_seconds = $hora_en_segundos;
        $permit->reason = $request['reason'];
        $permit->observations = $request['observations'];
        $permit->date_init = date("Y-m-d", strtotime($request['date_init']));
        $permit->worker_id = $request['worker_id'];

        $permit->save();

        return redirect('/home');
    }
}
