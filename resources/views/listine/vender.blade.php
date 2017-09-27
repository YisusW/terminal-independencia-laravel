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
                    
                      
                      <div class="col-sm-6 col-md-6">
                      
                        <div class="thumbnail">
                      
                          <img src="{{ url('/imagenes/listin-icon.png') }}" style="width: auto;height: auto">
                      
                          <div class="caption">
                            
                            <h2>Tipo Listin {{ $element->listine()->get()->first()->tipoListin()->get()->first()->descripcion }}</h2>
                            
                            <h3>Bs. {{ str_replace('.00', ',00', $element->listine()->get()->first()->precio) }}</h3>
                                            
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

                <button id="Cerrar_jornada" 
                type="button" 
                class="btn btn-success btn-lg btn-block"
                onclick="event.preventDefault();
                                document.getElementById('cierre-jorn').submit();""
                >Hacer Cierre de Jornada</button>

                <form id="cierre-jorn"  action="{{ url('cierre-jornada-listine') }}" method="POST" accept-charset="utf-8" style="display:none">
                                
                    {{ csrf_field() }}

                    @if( isset($jornada) )

                    <input type="hidden" name="jorna" value="{{ $jornada->id }}">

                    @endif

                </form>

                @elseif(session('option_reported'))


                    <form action="informe-cierre-jornada-listin" method="POST" accept-charset="utf-8"  target="_blank">
                        {{ csrf_field() }}
                        
                        <button type="submit" class="btn btn-primary" title="Reporte de cierre Jornada">Ver informe de Cierre Jornada</button>

                    </form>                 

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

<script type="text/javascript">
    
    $(document).ready(function() {
       
       $("#Cerrar_jornada"),click(function(event) {
           /* Act on the event */

           alert();
       });
    });

</script>

@endsection
