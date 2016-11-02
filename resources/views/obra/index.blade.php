@extends('layouts.app')

@section('htmlheader_title')
OBRAS
@endsection


@section('main-content')



<div class="container text-center">
    <div class="row">
        <div class="col-md-6">
            <div class="panel">
                <i class="fa fa-list-alt icon-home"></i>
                <a href="{{url('/obra/obra')}}" class="btn btn-warning btn-block btn-home-admin">OBRAS</a>
            </div>
        </div>



    </div>
</div>

@endsection
