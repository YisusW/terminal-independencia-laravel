<?php

namespace App\Http\Controllers\ListinTipo;

use Carbon\Carbon;
use App\TipoListinJornada;
use App\TipoListinJornadaPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TipoListinJornadaController extends Controller
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
    public function index( Request $request )
    {
        //

        $jornada = TipoListinJornada::where( 'description' , 'Abierta' )
        ->where( 'id_user' , \Auth::user()->id )
        ->get()->first();

        $listine = $jornada->listines_jornadas()->get() ;
        
        
        if( count( $jornada ) > 0 ):

             return view('listine.vender')->with(compact('jornada', 'listine')) ;
         else:

            $message  = 'No hay jornadas abiertas' ;

            return view('listine.vender')->with($message) ;

        endif;
               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $jornada , $listine_price )
    {
        //

        $listine =  new TipoListinJornadaPrice;

        $listine->id_tipo_listin_jornada = $jornada->id;
        $listine->id_tipo_listin_price = $listine_price;

        if( $listine->save() ):

            return true;
        else:
        
            $jornada->destroy();
            return false;
        endif;

    }

    protected function validar_jornada( $datos  ){

        return Validator::make( $datos , [
            'listin' => 'required|integer|exists:tipo_listin_price,id',
            'fecha_apertura_jornada' => 'required|date',
        ]);
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
        
        $validar = $this->validar_jornada( $request->all() );

        if( $validar->fails() )            
                return redirect('open-jornada-listine')->withErrors( $validar->errors() );


        
        if( $this->show( ) ):

            $jornada = $this->get_jornada_activa();

            if( $this->create( $jornada , (int) $request->listin ) ){


            $message = 'La Jornada Se Abrió Correctamente';
            return redirect('open-jornada-listine')->with(compact('message'));

            }

        endif;

        $jornada = new TipoListinJornada;

        $jornada->id_user = \Auth::user()->id ;
        $jornada->description = 'Abierta';
        $jornada->fecha = $request->fecha_apertura_jornada;        

        if( $jornada->save() && $this->create( $jornada , (int) $request->listin ) ):
            
            $message = 'La Jornada Se Abrió Correctamente';
            return redirect('open-jornada-listine')->with(compact('message'));

        else:

            $error = 'La Jornada No se pudo Abrir, ocurrió un error';
            return redirect('open-jornada-listine')->with(compact('error'));

        endif;


        
    }   
    
    protected function get_jornada_activa(){

        return TipoListinJornada::where( 'description' , 'Abierta' )
        ->where( 'id_user' , \Auth::user()->id )
        ->get()->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoListinJornada  $tipoListinJornada
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        
        $jornada = TipoListinJornada::where( 'description' , 'Abierta' )
        ->where( 'id_user' , \Auth::user()->id )
        ->get()->first();

        if( count( $jornada ) > 0 )
            return true;
        else return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoListinJornada  $tipoListinJornada
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoListinJornada $tipoListinJornada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoListinJornada  $tipoListinJornada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoListinJornada $tipoListinJornada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoListinJornada  $tipoListinJornada
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoListinJornada $tipoListinJornada)
    {
        //
    }
}
