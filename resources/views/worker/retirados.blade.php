@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Lista de Trabajadores Retirados</div>
                <div class="panel-body">

                    {{ Form::open(['route' => 'retirados', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
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
                        <h1 class="text-center">No existe trabajadores retirados</h1>
                    @else
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Puesto</th>
                                <th>Fecha Entrada</th>
                                <th>Fecha Retiro</th>
                                <th>Motivo de Retiro</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($workers as $worker)
                            <tr>
                                <td scope="row">{{$worker->id}}</td>
                                <td>{{$worker->name}}</td>
                                <td>{{$worker->cellphone}}</td>
                                <td>{{$worker->position}}</td>
                                <td>{{$worker->date_in}}</td>
                                <td>{{$worker->date_out}}</td>
                                <td>{{$worker->reason_retirement}}</td>
                                <td>
                                    
                                    <!-- Single button -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                        </button>
                                        <!--inicio Menu-->
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="{{ url('/worker/show/'.Crypt::encrypt($worker->id)) }}">Informacion de {{$worker->name}}</a></li> 
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
