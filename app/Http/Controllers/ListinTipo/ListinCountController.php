<?php

namespace App\Http\Controllers\ListinTipo;


use App\ListineCount;
use App\TipoListinJornadaPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;


class ListinCountController extends Controller
{

    public function __construct()
    {
        # code...
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $datos =  \App\TipoListinJornada::where('description' , 'Abierta')
        
        ->get();

        return view('listine.hacer_reporte_opened')->with(compact('datos'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function endindex()
    {
        //

        $datos =  \App\TipoListinJornada::where('description' , 'Cerrada')
        
        ->get();

        
        return view('listine.hacer_reporte_closed')->with(compact('datos'));

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
        //

        $count = new ListineCount;

        $count->id_tipo_listin_jornada_tipo_listin_price = (int) $request->id_listine_jornada ;

        if( $count->save() ){
            
            $numero = ListineCount::where('id_tipo_listin_jornada_tipo_listin_price' ,$count->id_tipo_listin_jornada_tipo_listin_price  )->count();

            if( $numero < 10 ) $numero = '000'.$numero;
            elseif( $numero < 100 ) $numero = '00'.$numero;
            elseif( $numero < 1000 ) $numero = '0'.$numero;
            
            $listin = $count->tipoListinJornadaPrice()->get()->first()->listine()->get()->first();

            $view =  \View::make('listine.pdf.listine-ticked' , compact( 'listin','numero') )->render();
            
            $pdf = \App::make('dompdf.wrapper');
                                           
            $pdf->loadHTML($view);

            return $pdf->stream();            
        }

    }

    public function reporte_informe_cierre ( Request $request ){


        $datos =  \App\TipoListinJornada::where('description' , 'Cerrada')
        
        ->where( 'id_user' , \Auth::user()->id )
        
        ->get()
        
        ->last();

        $listines_jornada = $datos->listines_jornadas()->get();


        $view =  \View::make('listine.pdf.informe-cierre-jornada' , compact('datos' , 'listines_jornada') )->render();
            
        $pdf = \App::make('dompdf.wrapper');
                                           
        $pdf->loadHTML($view);

        return $pdf->stream(); 

    }

    public function admin_reporte_informe_cierre ( Request $request ){


        $datos =  \App\TipoListinJornada::where('description' , 'Cerrada')
        
        ->where( 'id_user' , (int) $request->user )
        
        ->get()
        
        ->last();

        $listines_jornada = $datos->listines_jornadas()->get();

        $view =  \View::make('listine.pdf.informe-cierre-jornada' , compact('datos' , 'listines_jornada') )->render();
            
        $pdf = \App::make('dompdf.wrapper');
                                           
        $pdf->loadHTML($view);

        return $pdf->stream(); 

    }    




}
