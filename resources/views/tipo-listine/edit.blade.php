@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tipo Listín Editar</div>

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

                    <form class="form-horizontal" method="POST" action="{{ url('update-tipo-listin/'.$datos->id ) }}">
                        
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}                        

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Nómbre</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="nombre" required autofocus value="{{ $datos->descripcion }}">

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('estatus') ? ' has-error' : '' }}">
                            <label for="estatus" class="col-md-4 control-label">Estatus</label>

                            <div class="col-md-6">
                            
                                <select class="form-control" name="estatus">

                                    <option value="Inactivo" @if( $datos->status ==false ) selected="true" @endif >Inactivo</option>
                                    <option value="Activo" @if( $datos->status ==true ) selected="true" @endif >Activo</option>

                                </select>

                                @if ($errors->has('estatus'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('estatus') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">

                                <a  href="{{ url('tipo-listine') }}" role="button">volver</a>
                                <button type="reset" class="btn btn-default">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
