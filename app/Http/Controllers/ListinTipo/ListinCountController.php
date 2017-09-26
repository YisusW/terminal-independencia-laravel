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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

            $listin = $count->tipoListinJornadaPrice()->get()->first()->listine()->get()->first();

            $view =  \View::make('listine.pdf.listine-ticked' , compact( 'listin','numero') )->render();
            
            $pdf = \App::make('dompdf.wrapper');
                                           
            $pdf->loadHTML($view);

            return $pdf->stream();            
        }

    }

}
