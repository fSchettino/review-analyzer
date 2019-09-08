@extends('sharedView::layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>
                Welcome to Review Analyzer
            </h1>
        </div>
    </div>
    <div class="row margin-top-30">
        <div class="col-md-12 text-center">
            <p>Semantic review analisys software for hotels reviews.</p>
        </div>
    </div>
    <div class="row margin-top-30">
        <div class="col-md-4 offset-4 text-center">
                <a href="{{ url('/keywords') }}" role="button">Create some keywords</a><br>
                <a href="{{ url('/services') }}" role="button">Create some hotel services</a><br>
                <a href="{{ url('/rules') }}" role="button">Create a rule</a><br>
                <a href="{{ url('/hotels') }}" role="button">Create a hotel</a>
        </div>
    </div>
    <div class="row margin-top-30">
        <div class="col-md-12 text-center">
        <p>and then create a hotel review</p>
        </div>
    </div>
</div>
@endsection
