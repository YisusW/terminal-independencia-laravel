@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Jornada Tasa Salida</div>

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
                
                @if( isset($precio) )
                
                
                <form class="form-horizontal" action="open_jornada_user" method="POST" accept-charset="utf-8">

                {{ csrf_field() }}

                  <div class="form-group">

                    <label for="precio" class="col-md-4 control-label">Precio Activo:</label>
                    
                    <div class="col-md-6">
                        <div class="input-group">
                        <span class="input-group-addon">Bs.</span>
                        <select id=precio class="form-control" name="price" >                            

                                <option value="{{ $precio->id }}">{{ $precio->precio }}</option>
                                
                        </select>

                        </div>
                    </div>

                  </div> 
                    
                  <div class="form-group">

                    <label for="date" class="col-md-4 control-label">Fecha Jornada:</label>
                    <div class="col-md-6">
                        <input type="hidden" name="fecha_apertura_jornada" value="{{ $carbon->toDateString() }}">
                      
                        <input id="date"  type="date" class="form-control" readonly="true" value="{{ $fecha }}" >
                    </div>
                  </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="reset" class="btn btn-default">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Abrir Jornada
                                </button>
                            </div>
                        </div>
                </form>
               
                @else

                    <div class="alert alert-warning" role="alert">
                        <strong>Atención!</strong> Estamos esperando la configuración necesaria para comenzar
                    </div>

                @endif
                

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
