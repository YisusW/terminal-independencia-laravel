<?php

namespace App\Http\Controllers;


use App\TasaSalidaCount;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class TasaSalidaCountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct (){

         $this->middleware('auth');
         
    }

    public function index()
    {
        //

        $jornada = \App\TasaSalidaUser::where('description' , 'Abierta')->get();

        $usuario ;

        foreach ($jornada as $key => $value) {
            # code...
            $usuario[$key] = $value;

        }

        if( isset( $usuario ) ) (object) $usuario ;
        

        $fecha = Carbon::now('America/Caracas');

        return view('tasa-salida.hacer_reporte_admin')->with(compact( 'usuario' , 'fecha') );
    }


    public function endindex()
    {

       $jornada = \App\TasaSalidaUser::where('description' , 'Cerrada')->get();

        $usuario ;

        foreach ($jornada as $key => $value) {
            # code...
            $usuario[$key] = $value;

        }

        if( isset( $usuario ) ) (object) $usuario ;
        
        $fecha = Carbon::now();
        
        return view('tasa-salida.hacer_reporte_admin')->with(compact( 'usuario' , 'fecha') );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        # code...
        $count = new TasaSalidaCount;

        $carbon = Carbon::now('America/Caracas');

        $count->id_tasa_salida_date = (int) $request->precio ;

        $count->updated_at = $carbon ;

        $count->created_at = $carbon ;

        if( $count->save() ){
            
            $view =  \View::make('tasa-salida.pdf.report', compact('count'))->render();
            
            $pdf = \App::make('dompdf.wrapper');
                   
            $paper_size = array(0,0,400,400);
            
            $pdf->setPaper($paper_size); 
            
            $pdf->loadHTML($view);

            return $pdf->stream();            
        }

    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\TasaSalidaCount  $tasaSalidaCount
     * @return \Illuminate\Http\Response
     */
    public function show(TasaSalidaCount $tasaSalidaCount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TasaSalidaCount  $tasaSalidaCount
     * @return \Illuminate\Http\Response
     */
    public function edit(TasaSalidaCount $tasaSalidaCount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TasaSalidaCount  $tasaSalidaCount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TasaSalidaCount $tasaSalidaCount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TasaSalidaCount  $tasaSalidaCount
     * @return \Illuminate\Http\Response
     */
    public function destroy(TasaSalidaCount $tasaSalidaCount)
    {
        //
    }
}
