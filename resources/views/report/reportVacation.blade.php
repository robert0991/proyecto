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
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Vacaciones</h3>

                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Fecha Inicio</th>
                            <th>Nro Dias</th>
                            <th>Motivo</th>
                            <th>Observacion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($worker->vacations as $vacation)
                        @if($vacation->type == 'vacacion')
                        <tr>
                            <th scope="row">{{date("d/m/Y", strtotime($vacation->created_at))}}</th>
                            <th scope="row">{{date("d/m/Y", strtotime($vacation->date_init))}}</th>
                            <td>{{$vacation->days_taken}}</td>
                            <td>{{$vacation->reason}}</td>
                            <td>{{$vacation->observations}}</td>
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