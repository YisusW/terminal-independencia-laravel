<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <title>Listine</title>

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
   	
   	<img src="{{ public_path().'/imagenes/listine_header.jpg' }}" style="width: 100%" >

   </header><!-- /header -->

    <!--footer para cada pagina-->

    <div id="content" style="font-family:sans-serif;">
       
      <table>

          <tr>
            <td>
              {{ $listin->tipoListin()->get()->first()->descripcion }} - N° {{ $numero }}
            </td>
            
            
            <td style="text-align: right;">TIPO DE LISTIN</td>
            
            <th style="border: 1px solid black;text-align: right;" >Bs.{{ str_replace('.00', ',00', $listin->precio) }}</th>
          </tr>

      </table>

    </div>
   	  	
    
    <div id="footer">
        <!--aqui se muestra el numero de la pagina en numeros romanos-->
        
        <p class="page"></p>
        
    </div>    

	
  </body>
</html>
