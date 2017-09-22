@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Ver Jornadas en Curso</div>

                <div class="panel-body">

                @if( session('message') )

                    <div class="alert alert-success" role="alert">
                        <strong>Bien hecho!</strong> {{ session('message') }} 
                    </div>

                    @elseif( session('error') )
                    <div class="alert alert-danger" role="alert">
                        <strong>Ups!</strong> {{ session('error') }} 
                    </div>

                @endif



                <div class="table-responsive">
                <table class="table table-condensed" style="font-family: Georgia, Serif" >
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Fecha Hora Apertura</th>
                            <th>Cuenta</th>
                            <th>Precio</th>
                            <th style="text-align: right;">Total Bs.</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if( isset ($usuario) )
                        @foreach( $usuario as $jorn  )

                        <tr>
                            <td>{{ $jorn->user()->get()->first()->name }}</td>
                            
                            <td>{{ $jorn->created_at->formatLocalized('%A %d %B %Y') .' '. $jorn->created_at->format('h:i:s A') }}</td>
                            
                            <td>{{ $jorn->TasaSalidaCount()->get(['id_tasa_salida_date'])->count() }} Tasas</td>
                            
                            <td>{{ $jorn->tasaSalida()->get()->first()->precio }} Bs.</td>

                            <td style="text-align: right;" >{{ $jorn->tasaSalida()->get()->first()->precio * $jorn->TasaSalidaCount()->get(['id_tasa_salida_date'])->count().'.00' }} Bs.</td>

                            <td>

                                <button class="btn btn-primary btn-sm" type="button"

                                onclick="event.preventDefault();
                                
                                document.getElementById('hacer_cierre_admin').submit();"
                                
                                >Cerrar</button>

                                <button class="btn btn-primary btn-sm" type="button">PDF</button>
                                
                                <form id="hacer_cierre_admin" action="{{ url('informe-cierre-jornada-from-admin') }}" method="POST" target="_blank" style="display: none;">

                                    {{ csrf_field() }}

                                    <input type="hidden" name="user" value="{{ $jorn->user()->get()->first()->id }}">
                                    
                                    <input type="hidden" name="tasa_date" value="{{ $jorn->id }}">
                                
                                </form>
                            </td>
                        </tr>

                        @endforeach
                        @else
                        <tr> 
                            <td colspan="3"> 
                                <label class="text-danger"> No hay Jornadas abiertas </label>
                            </td> 
                        </tr>
                        @endif
                    </tbody>
                </table>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
