<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <title>Reporte Cierre Jornada</title>

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

table {
  border-collapse: separate;
  border-spacing:  5px 15px;
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

  </head>
  <body>


   <header id="header" class="">
   	
   	<img src="{{ public_path().'/imagenes/LOGO.png' }}" style="width: 100%" >

   </header><!-- /header -->

    <!--footer para cada pagina-->


    <div id="content" style="font-family:sans-serif;">
       
            <center><h1>INFORME JORNADA : {{ $tasa->user()->get()->first()->name }}</h1></center>

    	<table style="width: 100% ; border-collapse: separate;  border-spacing:  5px 15px;">

    		<thead>
    			<tr>
    				<th>Fecha Apertura</th>
    				<th>Hora Apertura</th>
    				
    			</tr>
    		</thead>

    		<tbody>
    			<tr>
    				<td>{{ $tasa->created_at->formatLocalized('%A %d %B %Y') }}</td>
    				<td>{{ $tasa->created_at->format('h:i:s A') }}</td>
    				
    			</tr>
    		</tbody>
                
            <thead>
                <tr>
                    <th>Fecha Cierre</th>
                    <th>Hora Cierre</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $tasa->updated_at->formatLocalized('%A %d %B %Y') }}</td>
                    <td>{{ $tasa->updated_at->format('h:i:s A') }}</td>
                </tr>
            </tbody>

            <thead>
                <tr>
                    <th>Tasas Vendidas</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $tasa->TasaSalidaCount()->get(['id_tasa_salida_date'])->count() }}</td>
                    <td>{{ $tasa->tasaSalida()->get()->first()->precio }} Bs.</td>
                    <td>{{ $tasa->tasaSalida()->get()->first()->precio * $tasa->TasaSalidaCount()->get(['id_tasa_salida_date'])->count().'.00' }} Bs.</td>
                </tr>
            </tbody>
    	</table>

        <table style="width: 100% ;">


        </table>

    </div>
   	  	
    
    <div id="footer">
        <!--aqui se muestra el numero de la pagina en numeros romanos-->
        
        <p class="page"></p>
        
    </div>    

	
  </body>
</html>
