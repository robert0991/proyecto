<?php

namespace App\Http\Controllers;

use PDF;
use App;
use App\Worker;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$workers = Worker::where('state',1);
        
        //return view('home')->with('workers',$workers->get());

        $name  = $request->get('name');

        $workers = Worker::where('state',1)
                        ->name($name)
                        ->orderBy('id', 'ASC')
                        ->paginate(20);

      return view('home', compact('workers'));
       //return view('home')->with('workers',$workers->get());
        
    }
    public function report(Request $request)
    {
        $name  = $request->get('name');

        $workers = Worker::where('state',1)
                        ->name($name)
                        ->orderBy('id', 'ASC')
                        ->paginate(10);
       /* $view =  view('report.report', compact('workers'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf = PDF :: loadView($view);
        return $pdf->stream(); 
        */
    return view('report.report', compact('workers'));
        
    }
    public function report1(Request $request)
    {
        $name  = $request->get('name');

        $workers = Worker::where('state',1)
                        ->name($name)
                        ->orderBy('id', 'ASC')
                        ->paginate(10);
       /* $view =  view('report.report', compact('workers'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf = PDF :: loadView($view);
        return $pdf->stream(); 
        */
    return view('report.reportWorker', compact('workers'));
        
    }

    public function welcome(){
        if (\Auth::check()) {
            return redirect('/home');
        }
        return redirect('/');
    }

}
