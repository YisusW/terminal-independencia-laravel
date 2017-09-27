<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <title>Reporte Jornada Cerrada </title>

    <style type="text/css" media="print">

	hr {
		page-break-after : always;
		border           : 0;
		margin           : 0;
		padding          : 0;
	}

	html {
	  margin: 0;
	}
    @page { margin: 180px 50px; }

    #header { 

		position         : fixed; 
		left             : 0px; 
		top              : -180px; 
		right            : 0px; 
		height           : 30px; 
		background-color : #333; 
		color            : #fff;
		text-align       : center; 
    }
    #footer { 

		position         : fixed; 
		left             : 0px; 
		bottom           : -180px; 
		right            : 0px; 
		height           : 30px; 
		background-color : #333; 
		color            : #fff;
    }
    #footer .page:after { 
        content: counter(page, upper-roman); 
    }
    </style>
    <style type="text/css">

    </style>
  </head>
  <body>


   <header id="header" class="">
   	
   	<img src="{{ public_path().'/imagenes/LOGO.png' }}" style="width: 100%" >

   </header><!-- /header -->

    <!--footer para cada pagina-->

    <div id="content" style="font-family:sans-serif;">
       
            <center><h1>INFORME JORNADA CERRADA - LISTIN</h1></center>
        <hr>
    	<table style="width: 100% ; 
            border-collapse: separate;  
            border-spacing:  5px 15px; ">

    		<thead>
                
    			<tr>
    				<th>Fecha Apertura</th>
    				<th>Hora Apertura</th>
                    <th>Nombre Usuario</th>
    			</tr>
                <tr>
                    <td>{{ $datos->created_at->formatLocalized('%A %d %B %Y') }}</td>
                    <td>{{ $datos->created_at->format('h:i:s A') }}</td>
                    <td>{{ $datos->user()->get()->first()->nombre .' '. $datos->user()->get()->first()->apellido }}</td>
                </tr> 

                <tr>
                    <th>Fecha Cierre</th>
                    <th>Hora Cierre</th>
                </tr>
                <tr>
                    <td>{{ $datos->updated_at->formatLocalized('%A %d %B %Y') }}</td>
                    <td>{{ $datos->updated_at->format('h:i:s A') }}</td>
                </tr>  
                {{-- ULTIMA LINEA DE  LA TABLA INFORMACION DE LAS TASAS GENERADAS --}}

            </thead>
            <tbody>
                <tr>
                    <th>Tipo Listin</th>
                    <th>Precio</th>
                    <th>Vendidos</th>
                    <th>Total</th>
                </tr>

                @foreach ($listines_jornada as $element)
                <tr>
                    <td>{{ $element->listine()->get()->first()->tipoListin()->get()->first()->descripcion }}</td>
                    
                    <td>{{ str_replace('.00', ',00', $element->listine()->get()->first()->precio) }} Bs.</td>
                    
                    <td>{{ $element->ListineCount()->get(['id_tipo_listin_jornada_tipo_listin_price'])->count() }}</td>
                    
                    <td>{{ number_format( $element->ListineCount()->get(['id_tipo_listin_jornada_tipo_listin_price'])->count()  * $element->listine()->get()->first()->precio , 2, ',', ' ')  }} Bs.</td>
                </tr>
                @endforeach
  

            </tbody>
    	</table>
    </div>
   	  	
    
    <div id="footer">
        <!--aqui se muestra el numero de la pagina en numeros romanos-->
        <hr>
        <p class="page"></p>
        
    </div>    

	
  </body>
</html>
