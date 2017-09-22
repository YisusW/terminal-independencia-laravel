@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Asignar Precio Tipo Listín</div>

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

                    <form class="form-horizontal" method="POST" action="{{ url('save-tipo-price') }}">
                        
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('tipo_listine') ? ' has-error' : '' }}">
                            <label for="tipo_listine" class="col-md-4 control-label">Tipo Listin</label>

                            <div class="col-md-6">
                                
                                <select class="form-control" name="tipo_listine" required  autofocus>
                                    
                                    <option value=""> Seleccione un Tipo </option>
                                    @if( isset( $tipo ) )
                                        @foreach( $tipo as $tipe_one )
                                        <option value="{{ $tipe_one->id }}" >{{ $tipe_one->descripcion }}</option>
                                        @endforeach                                   
                                    @endif
                                </select>

                                @if ($errors->has('tipo_listine'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo_listine') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('precio') ? ' has-error' : '' }}">
                            <label for="precio" class="col-md-4 control-label">Precio</label>

                            <div class="col-md-6">

                              <div class="input-group">
                                
                                <input id="precio" type="numeric" class="form-control" name="precio" placeholder="500,00" required>
                                <span class="input-group-addon">Bs.</span>
                              </div>  

                                @if ($errors->has('precio'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('precio') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('estatus') ? ' has-error' : '' }}">
                            <label for="estatus" class="col-md-4 control-label">Estatus</label>

                            <div class="col-md-6">
                            
                                <select class="form-control" name="estatus" required >

                                    <option value="Inactivo">Inactivo</option>
                                    <option value="Activo">Activo</option>

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
                                <button type="reset" class="btn btn-default">
                                    Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>


                <div class="col-md-12">

                  <div class="table-responsive">
                    <table class="table table-condensed" >

                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Listín</th>
                          <th>Precio</th>
                          <th>Estatus</th>
                          <th>Opción</th>
                        </tr>
                      </thead>
                      <tbody>

                        @if( isset($listin_precio) )
                        @foreach( $listin_precio as $key => $listin )

                            <tr @if( $listin->status == true ) class="success" @endif >
                                <td>{{ $key+1 }}</td>
                                <td>{{ $listin->tipoListin()->get()->first()->descripcion }}</td>
                                <td>{{ $listin->precio }} Bs.</td>
                                <td>@if( $listin->status == true ) Activo @else Inactivo @endif</td>
                                <td></td>
                            </tr>

                        @endforeach
                        @endif

                      </tbody>
                    </table>
                  </div>
                  
                </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
