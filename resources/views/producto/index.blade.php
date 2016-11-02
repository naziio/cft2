@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container-narrow">
        <h2>Ingreso de producto</h2>
        <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">Agregar PRODUCTO</button>
        <div>

            <!-- Table-to-load-the-data Part -->
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Razon social</th>
                    <th>RUT</th>
                    <th>Numero</th>
                    <th>Fecha</th>
                    <th>Subtotal</th>
                    <th>Detalle</th>
                </tr>
                </thead>