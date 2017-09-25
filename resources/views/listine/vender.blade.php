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
                
                <div class="row">

                @foreach ($listine as $key => $element)

                    {{-- expr --}}
                    
                      
                      <div class="col-sm-6 col-md-4">
                      
                        <div class="thumbnail">
                      
                          <img src="{{ url('/imagenes/LOGO.png') }}" alt="">
                      
                          <div class="caption">
                      
                            <h3>Bs. {{ $element->listine()->get()->first()->precio .'-'.  $element->listine()->get()->first()->tipoListin()->get()->first()->descripcion }}</h3>
                      
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
