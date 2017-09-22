@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Nómbre</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" required autofocus>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('estatus') ? ' has-error' : '' }}">
                            <label for="estatus" class="col-md-4 control-label">Estatus</label>

                            <div class="col-md-6">
                            
                                <select class="form-control" name="estatus">

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
                          <th>Nómbre</th>
                          <th>Estatus</th>
                          <th>Opción</th>
                        </tr>
                      </thead>
                      <tbody>

                        

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
