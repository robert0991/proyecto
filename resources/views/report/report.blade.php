@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Reporte Vaciones de Trabajadores Activos</div>
                <div class="panel-body">              

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