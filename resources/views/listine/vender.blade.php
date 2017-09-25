@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Vende Listin</div>

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
           
                
                <form class="form-horizontal" action="tasa-salida-report" method="POST" accept-charset="utf-8"  target="_blank">

                  <div class="form-group">

                    <label for="precio" class="col-md-4 control-label">Precio Activo:</label>
                    <div class="col-md-6">
                        <div class="input-group">

                        <input id="monto" type="text" class="form-control" readonly="true" value="">
                        <span class="input-group-addon">Bs.</span>

                        </div>
                    </div>

                  </div>
                    
                
                  {{--  --}}
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">                 
                    <button id="hacer_report" type="submit" class="btn btn-primary" value="tasa">Imprimir</button>

                    <a href="" class="btn btn-success" title="deseas cerrar la jornada?" role="button">Cerrar Jornada</a>
                    </div>
                </div>                             
                </form>
               
{{--                 @else

                    <div class="alert alert-warning" role="alert">
                        <strong>Atención!</strong> Estamos esperando la configuración necesaria para comenzar
                    </div>

                @endif --}}
                

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
