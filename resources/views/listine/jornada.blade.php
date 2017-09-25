@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Jornada Listine</div>

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
                @if( isset( $listine ) )
                @if( count( $listine ) > 0 )
                    <form class="form-horizontal" method="POST" action="{{ url('open-jornada-listine') }}" accept-charset="utf-8">
                        
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('listin') ? ' has-error' : '' }}">
                            <label for="tipo_listine" class="col-md-4 control-label">Precio Listin Activo:</label>

                            <div class="col-md-6">
                                
                                <div class="input-group">
                                <span class="input-group-addon">Bs.</span>
                                <select class="form-control" name="listin" required >
                                    
                                        @foreach( $listine as $listin )
                                        <option value="{{ $listin->id }}" >
                                            {{ 
                                                $listin->precio
                                                .' - '.
                                                $listin->tipoListin()->get()->first()->descripcion 
                                            }}
                                        </option>
                                        @endforeach                                   
                                    
                                </select>
                                </div>
                                @if ($errors->has('tipo_listine'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo_listine') }}</strong>
                                    </span>
                                @endif
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
                    <div class="alert alert-info" role="alert">
                        <strong>Importante!</strong> Para Hacer la apertura de una jornada es necesario hacer las configuraciones necesarias previamente
                    </div>        
                @endif
                @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
