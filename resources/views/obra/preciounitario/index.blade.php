@extends('layouts.app')

@section('htmlheader_title')
Precio unitario
@endsection


@section('main-content')
<div class="container">
    <div class="container-narrow">
        <h2>Analisis de precio unitario</h2>
        <div>

            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ITEM</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Total</th>

                </tr>
                </thead>
                <tbody >
                @foreach ($preciounitario as $preciounitarios)
                <tr id="preciounitario{{$preciounitarios->id}}">
                    <td>{{$preciounitarios->id}}</td>
                    <td>{{$preciounitarios->item}}</td>
                    <td>{{$preciounitarios->cantidad}}</td>
                    <td>{{$preciounitarios->subtotal}}</td>
                    <td>{{$preciounitarios->total}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
    >
    </div>

    </body>


</div>
</div>








<meta name="_token" content="{!! csrf_token() !!}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{asset('js/sistemalaravel.js')}}"></script>
@stop

