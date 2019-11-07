@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Trabajadores Activos</div>
                <div class="panel-body">
                
                
                        {{ Form::open(['route' => 'home', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                            <div class="form-group">
                                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) }}
                            </div>
                            
                          
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        {{ Form::close() }}
                    
                

                    @if($workers->isEmpty())
                    <h1 class="text-center">No existe trabajadores registrados</h1>
                    @else
                        <table class="table table-hover">
                            <thead>
                            <tr >
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="success" style="text-align:center" colspan="3">Dias Vacaciones</th>
                                <th class="success" style="text-align:center" colspan="3">Permisos</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Fecha Entrada</th>
                                <th>Area</th>
                                <th>Puesto</th>
                                <th class="success">Ganados</th>
                                <th class="success">Tomados</th>
                                <th class="success">Restantes</th>
                                <th class="success">Dias</th>
                                <th class="success">Horas</th>
                                <th class="success">Hrs/Dias</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($workers as $worker)
                            <tr>
                                <td scope="row">{{$worker->id}}</td>
                                <td>{{$worker->name}}</td>
                                <td>{{$worker->cellphone}}</td>
                                <td>{{$worker->date_in}}</td>
                                <td>{{$worker->area->name}}</td>
                                <td>{{$worker->position}}</td>
                                <td class="success">{{$vacationDays=MyHelper::vacationDays($worker->date_in)}}</td>
                                <td class="success">{{$vacationTaken=MyHelper::vacationTaken($worker->id)}}</td>
                                <td class="success">{{$vacationDays-$vacationTaken}}</td>
                                <td class="success">{{$workPermit=MyHelper::workPermitDays($worker->id)}}</td>
                                <td class="success">{{$workPermitHours=MyHelper::workPermitHours($worker->id)}}</td>
                                <td class="success">{{$seg_a_dhms=MyHelper::seg_a_dhms($worker->id)}}</td>
                                <td>
                                    
                                    <!-- Single button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <!--inicio Menu-->
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ url('/worker/show/'.Crypt::encrypt($worker->id)) }}">Informacion de {{$worker->name}}</a></li>
                                            <li class="divider"></li>
                                            <li><a href="{{ url('/vacation/create/'.Crypt::encrypt($worker->id).'/'.Crypt::encrypt($worker->name)) }}">Asignar Vacaciones</a></li>
                                          
                                            <li class="divider"></li>
                                            <li class="dropdown-submenu">
                                                <a tabindex="-1" href="#">Asignar Permiso</a>
                                                <ul class="dropdown-menu">
                                                    <!--NO APARECE EL SUB MENU-->
                                                    <li><a tabindex="-1" href="{{ url('/permit/create/'.Crypt::encrypt($worker->id).'/'.Crypt::encrypt($worker->name)) }}">Permiso por dias</a></li>
                                                    <li><a tabindex="-1" href="{{ url('/permit/create1/'.Crypt::encrypt($worker->id).'/'.Crypt::encrypt($worker->name)) }}" >Permiso por horas</a></li>
                                                </ul>
                                            </li>  
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
