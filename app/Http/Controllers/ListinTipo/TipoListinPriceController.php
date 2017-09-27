<?php

namespace App\Http\Controllers\ListinTipo;

use Carbon\Carbon;
use App\TipoListinPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TipoListinPriceController extends Controller
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

    protected function validar_registro ( $data ){

        return Validator::make($data, [

            'tipo_listine' => 'required|exists:tipo_listin,id',

            'precio' => 'required|numeric|unique:tipo_listin_price,precio',

            'estatus' => 'required|string',

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

        $validar =  $this->validar_registro( $request->all() );

        if( $validar->fails() ){
            //dd( $validar->errors() ) ;
            return redirect('tipo-listine-price')

            ->withErrors( $validar->errors() );
            
        }

        $price  = new TipoListinPrice;

        $price->id_tipo_listin = (int) $request->tipo_listine;
        $price->precio = $request->precio ;

        $estatus = ( $request->estatus == 'Activo'  ) ? true : false ;

        $price->status = $estatus;
        
        if ( $price->save() ){

            $message = 'El precio fué guardado correctamente';

            $tipo =  \App\TipoListin::where( 'status' , 't' )->get([ 'id' , 'descripcion' , 'status' ]);

            $listin_precio = \App\TipoListinPrice::orderBy( 'status' , 'desc' )

            ->orderBy( 'created_at' , 'desc' )

            ->get();

            return redirect('tipo-listine-price')->with(compact('message' , 'tipo' , 'listin_precio'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoListinPrice  $tipoListinPrice
     * @return \Illuminate\Http\Response
     */
    public function show(TipoListinPrice $tipoListinPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoListinPrice  $tipoListinPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoListinPrice $tipoListinPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoListinPrice  $tipoListinPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoListinPrice $tipoListinPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoListinPrice  $tipoListinPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoListinPrice $tipoListinPrice)
    {
        //
    }

    public function vista_jornada_open( Request $request ){

        $listine = TipoListinPrice::where('status' , 't')->get();

        $carbon = Carbon::now('America/Caracas');

        $fecha =  $carbon->formatLocalized('%A %d %B %Y');
        
        $jornada = \App\TipoListinJornada::where( 'description' , 'Abierta' )
        ->where( 'id_user' , \Auth::user()->id )
        ->get()->first();
        
        if( count( $jornada ) > 0 ):

            $listinei = $jornada->listines_jornadas()->get() ;
            return view('listine.jornada')->with(compact('listine' , 'fecha' , 'carbon' , 'listinei'));
            
        else:
            
            return view('listine.jornada')->with(compact('listine' , 'fecha' , 'carbon'));

        endif;

        
    }

}
