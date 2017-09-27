@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ver Jornadas Cerradas</div>

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
                <table class="table table-condensed" style="font-family: Georgia, Serif">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Fecha Hora Apertura</th>

                            <th style="text-align: right;">Total Bs.</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ( isset( $datos ))
                            {{-- expr --}}

                            @foreach ($datos as $element)
                                {{-- expr --}}
                                <tr>

                                    <td>{{ $element->user()->get()->first()->nombre .' '. $element->user()->get()->first()->apellido}}</td>
                                    <td>{{ $element->created_at->formatLocalized('%A %d %B %Y') .' '. $element->created_at->format('h:i:s A') }}</td>

                                    <td></td>
                                    <td>
                                <button class="btn btn-primary btn-sm" type="button"
                                
                                >Ver</button>

                                <button class="btn btn-primary btn-sm" 
                                type="button"
                                onclick="event.preventDefault();
                                
                                document.getElementById('informe_cierre_admin').submit();"
                                >PDF</button>
                                
                                <form id="informe_cierre_admin" action="{{ url('informe-cierre-jornada-listine-from-admin') }}" method="POST" target="_blank" style="display: none;">

                                    {{ csrf_field() }}

                                    <input type="hidden" name="user" value="{{ $element->user()->get()->first()->id }}">
                                    
                                    <input type="hidden" name="tasa_date" value="{{ $element->id }}">
                                {{-- 3157964--}}
                                </form>                                        
                                    </td>
                                </tr>

                            @endforeach

                        @else

                        <tr> 
                            <td colspan="6"> 
                                <label class="text-danger"> No hay Jornadas Cerradas </label>
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
