<?php

namespace App\Http\Controllers\ListinTipo;

use App\TipoListin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoListinController extends Controller
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
        $tipo = TipoListin::orderBy('status' , 'desc')->get();



        return view('tipo-listine.create')->with( compact('tipo') );
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

        $tipo_listine = new TipoListin;

        $status = ( $request->estatus == 'Activo'  ) ? true : false ;

        $tipo_listine->descripcion  = $request->description;

        $tipo_listine->status  = $status ;
     
        if( $tipo_listine->save() ){

            if ( $tipo_listine->status == true ) {


                $this->cambiar_estatus( $tipo_listine );
            }

            $message = 'El tipo de fue guardado correctamente';

            $tipo = TipoListin::orderBy('status' , 'desc')->get();

            return redirect('tipo-listine')->with( compact('message' , 'tipo') );            

        }


    }

    protected function cambiar_estatus( $tipo ){

        $every = TipoListin::where( 'id' , '!=' , $tipo->id )->where('status' , true )->get();

        foreach ($every as $key => $value) {
            # code...
            $value->status = false;
            $value->update();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoListin  $tipoListin
     * @return \Illuminate\Http\Response
     */
    public function show(TipoListin $tipoListin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipoListin  $tipoListin
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoListin $tipoListin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoListin  $tipoListin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoListin $tipoListin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoListin  $tipoListin
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoListin $tipoListin)
    {
        //
    }

    public function config_price( Request $request )
    {
       
        $tipo =  TipoListin::where( 'status' , 't' )->get([ 'id' , 'descripcion' , 'status' ])->first();

        return view('listine.price')->with(compact('tipo'));
    }    
}
