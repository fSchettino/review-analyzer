@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Hotel Details
            </h1>
            <a class="btn btn-outline-primary btn-sm" href="{{ url('/hotel/edit/1') }}" role="button">Edit Hotel Details</a>
            <a class="btn btn-outline-primary btn-sm" href="#" role="button">Add Hotel Review</a>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/hotels') }}" role="button">Back</a>
        </div>
    </div>
</div>
@endsection
