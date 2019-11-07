<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class AreaController extends Controller
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
        $areas = Area::all();
        return view('area.index')->with('areas',$areas);
    }

    public function create()
    {
        return view('area.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $name = $request['name'];
        $description = $request['description'];

        $area = new Area();
        $area->name = $name;
        $area->description = $description;

        $area->save();

        return redirect('/area');
    }
    public function edit($id)
    {
       
        $area = Area::find($id);
        return view('area.edit', compact('area'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'id_area' => 'required'
        ]);

        $area = Area::find($request['id_area']);
        $area->name = $request['name'];
        $area->description = $request['description'];
        $area->save();

        return redirect()-> route('area.index')
                         ->with('info', 'El area fue actualizada');
    }
}
