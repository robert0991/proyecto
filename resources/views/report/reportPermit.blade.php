@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left">Datos del Trabajador</h3>
                </div>
                <div class="panel-body">

                    <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Estado</th>
                                <th>Nombre</th>
                                <th>CI</th>
                                <th>Celular</th>
                                <th>Email</th>
                                <th>Fecha de Ingreso</th>
                                <th>Puesto</th>
                                <th>Area</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                
                                <td>{{ MyHelper::stateWorker($worker->state)}}</td>
                                <td>{{$worker->name}}</td>
                                <td>{{$worker->ci}}</td>
                                <td>{{$worker->cellphone}}</td>
                                <td>{{$worker->email}}</td>   
                                <td>{{$worker->date_in}}</td> 
                                <td>{{$worker->position}}</td> 
                                <td>{{$worker->area->name}}</td>     
                            </tr>
                            </tbody>
                        </table>
                    
                </div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title">Permisos</h3>

                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Fecha Inicio</th>
                            <th>Nro Dias</th>
                            <th>Nro Horas</th>
                            <th>Motivo</th>
                            <th>Observacion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($worker->permissions as $permission)
                        @if($permission->type == 'permiso')
                        <tr>
                            <th scope="row">{{date("d/m/Y", strtotime($permission->created_at))}}</th>
                            <th scope="row">{{date("d/m/Y", strtotime($permission->date_init))}}</th>
                            <td>{{$permission->days_taken}}</td>
                            <td>{{$permission->permit_hours}}</td>
                            <td>{{$permission->reason}}</td>
                            <td>{{$permission->observations}}</td>
                        </tr>
                        @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
{!! Html::script('js/moment.min.js') !!}
{!! Html::script('js/bootstrap-datetimepicker.min.js') !!}
<script type="text/javascript">
    $('#date-out').datetimepicker({
        format: 'DD-MM-YYYY'
    });
</script>
@endsection