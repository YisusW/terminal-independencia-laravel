@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Jornada Tasa Salida</div>

                <div class="panel-body">

                @if( isset( $message )  )

                    <div class="alert alert-success" role="alert">
                        <strong>Bien hecho!</strong> {{ $message }} 
                    </div>
                    
                @elseif( isset($error) )

                    <div class="alert alert-error" role="alert">
                        <strong>Ups!</strong> {{ $error }} 
                    </div>

                @endif
                
                <form class="form-horizontal" action="save-price-tasa" method="post" accept-charset="utf-8">

                  {{ csrf_field() }}
                
                  <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    
                    <label for="precio" class="col-md-4 control-label">Precio</label>
                    <div class="col-md-6">
                      <div class="input-group">
                        
                        <input id="precio" type="text" class="form-control" name="price" placeholder="50,00">
                        <span class="input-group-addon">Bs.</span>
                      </div>
      
                      @if ($errors->has('price'))
                          <span class="help-block">
                              <strong>{{ $errors->first('price') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                    
                  <div class="form-group">

                    <label for="precio"  class="col-md-4 control-label" >Estatus</label>
                    <div class="col-md-6">
                      <select name="status" class="form-control" name="estatus" >
                        
                        <option value="Inactivo">Inactivo</option>
                        <option value="Activo">Activo</option>
                      
                      </select>
                     
                   </div>
                  </div> 
                  
                  {{--  --}}                  
                  
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
                    <table class="table  table-condensed table-hover" >

                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Precio</th>
                          <th>Estatus</th>
                          <th>Opción</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if( isset($tasa) ) 

                      @foreach( $tasa as $key => $taserm )

                        <tr @if( $taserm->status == true ) class="success" @endif >
                          
                          <td> {{ $key+1 }} </td>
                          <td>{{ $taserm->precio }}Bs.</td>
                          <td>@if( $taserm->status == true ) Activo @else Inactivo @endif</td>
                          <td></td>

                        </tr>

                      @endforeach

                      @else
                        <tr>
                          <td colspan="4">
                            <label class="text-danger">No Hay Registros</label>
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
</div>
@endsection
