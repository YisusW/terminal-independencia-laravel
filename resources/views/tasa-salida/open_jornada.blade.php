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
                
                <div class="col-md-8 col-md-offset-2">

                <form action="open_jornada_user" method="POST" accept-charset="utf-8">

                {{ csrf_field() }}

                  <div class="form-group">

                    <label for="precio">Precio Activo:</label>
                    <div class="input-group">
                    <span class="input-group-addon">Bs.</span>
                    <select id=precio class="form-control" name="price" >                            

                            <option value="{{ $precio->id }}">{{ $precio->precio }}</option>
                            
                    </select>

                    </div>
                  </div> 
                    
                  <div class="form-group">
                    <label for="date">Fecha Jornada:</label>
                  
                    <input type="hidden" name="fecha_apertura_jornada" value="{{ $carbon->toDateString() }}">
                  
                    <input id="date"  type="date" class="form-control" readonly="true" value="{{ $fecha }}" >
                  
                  </div>                    
                  
                  <button type="submit" class="btn btn-primary">Abrir</button>
                  
                </form>

                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
