@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Usuarios</div>

                <div class="panel-body">

                @if( isset($message) )

                    <div class="alert alert-success" role="alert">
                        <strong>Bien hecho!</strong> {{ $message }} 
                    </div>
                    @elseif( isset($error) )
                    <div class="alert alert-success" role="alert">
                        <strong>Ups!</strong> {{ $error }} 
                    </div>
                @endif

                <table class="table table-condensed" >
                <caption>Usuarios No verificados</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Fecha Registro</th>
                            <th>Opción</th>
                        </tr>
                    </thead>
                    <tbody> 
                    @if( count($user) > 0   )
                    @foreach( $user as $key => $user_indi )

                        <tr>
                            <td  >
                            <label style="display:none" ></label>
                            {{ $key+1 }}
                            </td>
                            <td>{{ $user_indi->name }}</td>
                            <td>{{ $user_indi->nombre }}</td>
                            <td>{{ $user_indi->apellido }}</td>
                            <td>{{ $user_indi->created_at->formatLocalized('%A %d %B %Y') }}</td>
                            <td> <a href="{{ url('users/'.$user_indi->id) }}" type="button" class="btn btn-primary">Activar</a> </td>

                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
