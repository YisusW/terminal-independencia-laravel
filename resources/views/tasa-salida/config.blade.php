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
                
                <div class="col-md-8 col-md-offset-2">

                <form action="save-price-tasa" method="post" accept-charset="utf-8">

                  {{ csrf_field() }}
                
                  <div class="form-group">
                    <label for="precio">Precio:</label>
                      <div class="input-group">
                        
                        <input id="precio" type="text" class="form-control" name="price" placeholder="50,00">
                        <span class="input-group-addon">Bs.</span>
                      </div>

                      <span class="help-block"></span>
                  </div>
                    
                  <div class="form-group">

                    <label for="precio">Estatus:</label>
                      <select name="status" class="form-control" name="estatus" >
                        
                        <option value="Inactivo">Inactivo</option>
                        <option value="Activo">Activo</option>
                      
                      </select>

                     <span class="help-block"></span>
                  </div> 
                  
                  {{--  --}}                  
                  
                  <button type="reset" class="btn btn-default">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </form>



                </div>

                <div class="col-md-12">

                  <div class="table-responsive">
                    <table class="table table-condensed" >

                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Precio</th>
                          <th>Estatus</th>
                          <th>Opción</th>
                        </tr>
                      </thead>
                      <tbody>

                      @foreach( $tasa as $key => $taserm )

                        <tr @if( $taserm->status == true ) class="success" @endif >
                          
                          <td> {{ $key+1 }} </td>
                          <td>{{ $taserm->precio }}Bs.</td>
                          <td>@if( $taserm->status == true ) Activo @else Inactivo @endif</td>
                          <td></td>

                        </tr>

                      @endforeach

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
