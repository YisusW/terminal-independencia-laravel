<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <title>Tasa Salida Reporte</title>

    <style type="text/css">

	hr {
	  page-break-after: always;
	  border: 0;
	  margin: 0;
	  padding: 0;
	}

	@font-face
	{
		font-family: Arial, Helvetica, sans-serif;
	   	src: url("fuentefancy.eot");
	   	src: url("fuentefancy.eot?#amocristalab") format("embedded-opentype"),
	        url("fuentefancy.woff") format("woff"),
	        url("fuentefancy.ttf") format("truetype"),
	        url("fuentefancy.svg#IDdelafuente") format("svg");
	}
	html {
	  margin: 0;
	}
	body {
	  font-family: "Times New Roman", serif;
	}
	h2{
		font-family: "sans-serif";
	    font-size: 15;
	}
	h1	{
		font-family: "sans-serif";
	}
    </style>

  </head>
  <body>


   <header id="header" class="">
   	
   	<img src="{{ public_path().'/imagenes/header.png' }}" style="width: 100%" >

   	<h2 align="center" style="  width: 100% ">

   		<font style="font-size: 24; font-weight: normal; ">TERMINAL DE PASAJEROS</font>

   		<br>

   		<font style="font-size: 36; font-weight: bold;">TASA DE SALIDA</font>

   		<br>

   		<font style="font-size: 65; font-weight: bold;">{{ str_replace('.00', ',00', $count->TasaSalidaUser()->get()->first()->tasaSalida()->get()->first()->precio)  }}Bs.</font>

   		<br>

   		<font style="font-size: 40; font-weight: normal; color:#8D8D8D">N° {{ $numero }}</font>

   		<br>

   		<font style="font-size: 20; font-weight: normal; ">{{ $count->created_at->formatLocalized('%A %d %B %Y') }}</font>

   	</h2>

   </header><!-- /header -->
	
  </body>
</html>
