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
                
                
                @if(isset($listine))
                <div class="row">
                @foreach ($listine as $key => $element)

                    {{-- expr --}}
                    
                      
                      <div class="col-sm-8 col-md-6">
                      
                        <div class="thumbnail">
                      
                          <img src="{{ url('/imagenes/LOGO.png') }}" alt="">
                      
                          <div class="caption">
                            
                            <h2>Tipo Listin {{ $element->listine()->get()->first()->tipoListin()->get()->first()->descripcion }}</h2>
                            
                            <h3>Bs. {{ $element->listine()->get()->first()->precio }}</h3>
                      
                            <p>...</p>
                      
                            <p><a onclick="event.preventDefault();
                                             document.getElementById('count-of-listine{{ $key }}').submit();" href="#" class="btn btn-primary" role="button" >Imprimir</a></p>
                            
                            <form id="count-of-listine{{ $key }}" action="{{ url('contar-listine') }}" method="post" accept-charset="utf-8" target="_blank" style="display:none">
                                
                                {{ csrf_field() }}
                                <input type="hidden" name="id_listine_jornada" value="{{ $element->id }}">

                            </form>


                          </div>                      

                        </div>
                    
                      </div>                                          
                    
                @endforeach
                </div>

                <button type="button" class="btn btn-success btn-lg btn-block">Hacer Cierre de Jornada</button>

                @else
                
                    <div class="col-sm-12">
                    <div class="alert alert-info" role="alert">
                        <strong>Importante!</strong> Debes primero hacer la apertura de jornada
                    </div>
                    </div>
                
                @endif
                



               
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
