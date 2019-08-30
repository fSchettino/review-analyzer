@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>
                Something goes wrong!
            </h1>
        </div>
    </div>
    <div class="row margin-top-30">
        <div class="col-md-12 text-center">
            <p>An error occurred.</p>
            <p>{{ $error }}</p>
        </div>
    </div>
</div>
@endsection
