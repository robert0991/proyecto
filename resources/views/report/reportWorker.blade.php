@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Reporte del Trabajadores Activos</div>
                <div class="panel-body">                    

                    @if($workers->isEmpty())
                    <h1 class="text-center">No existe trabajadores registrados</h1>
                    @else
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Area</th>
                                <th>Puesto</th>
                                <th>General</th>
                                <th>Vacacion</th>
                                <th>Permiso</th>
                                <th>Compensacion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($workers as $worker)
                            <tr>
                                <td scope="row">{{$worker->id}}</td>
                                <td>{{$worker->name}}</td>
                                <td>{{$worker->area->name}}</td>
                                <td>{{$worker->position}}</td>
                                <td>
                                    
                                    <!-- Single button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <!--inicio Menu-->
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ url('/worker/report/'.Crypt::encrypt($worker->id)) }}">General</a></li>                                                 
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    
                                    <!-- Single button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <!--inicio Menu-->
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ url('/worker/reportVacation/'.Crypt::encrypt($worker->id)) }}">Vacacion</a></li>                                                 
                                        </ul>
                                    </div>
                                </td>                           
                                <td>
                                    
                                    <!-- Single button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <!--inicio Menu-->
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ url('/worker/reportPermit/'.Crypt::encrypt($worker->id)) }}">Permiso</a></li>                                                 
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    
                                    <!-- Single button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <!--inicio Menu-->
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ url('/worker/reportOther/'.Crypt::encrypt($worker->id)) }}">Otros</a></li>                                                 
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
