@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Vender Tasa Salida</div>

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

                @if( session('info') )

                
                    <div class="alert alert-info" role="alert">
                        <strong>Importante!</strong> {{ session('info') }} 
                    </div>

                @endif

                @if( isset($tasa) )
                <div class="col-md-8 col-md-offset-2">

                
                <form action="tasa-salida-report" method="POST" accept-charset="utf-8"  target="_blank">

                
                    {{ csrf_field() }}
                    <input type="hidden" name="precio" readonly="true" value="{{ $tasa->id }}">
                    {{ csrf_field() }}

                  <div class="form-group">

                    <label for="precio">Precio Activo:</label>
                    <div class="input-group">

                    <input id="monto" type="text" class="form-control" readonly="true" value="{{ $tasa->tasaSalida()->get()->first()->precio }}">
                    <span class="input-group-addon">Bs.</span>

                    </div>

                  </div>
                    
                
                  {{--  --}}
                 
                  <button id="hacer_report" type="submit" class="btn btn-primary" value="tasa">Imprimir</button>

                  <a href="{{ url('cierre-jornada/'.Auth::user()->id.'/'.$tasa->id ) }}" class="btn btn-success" title="deseas cerrar la jornada?" role="button">Cerrar Jornada</a>
                                                    
                </form>


                </div>
                @elseif( session('option_reported') )

                    <div class="alert alert-info" role="alert">
                        <strong>Importante!</strong> Para seguir vendiendo debes abrir una nueva jornada
                    </div>
                    <form action="informe-cierre-jornada" method="POST" accept-charset="utf-8"  target="_blank">
                        {{ csrf_field() }}
                        
                        <button type="submit" class="btn btn-info" title="Reporte de cierre Jornada">Ver informe Jornada</button>

                    </form>    

                @else
                    
                    <div class="alert alert-info" role="alert">
                        <strong>Importante!</strong> Para seguir vendiendo debes abrir una nueva jornada
                    </div>

                @endif                

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
