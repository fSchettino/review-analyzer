@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Service Details
            </h1>
            <a class="btn btn-outline-primary btn-sm" href="{{ url('/service/edit/1') }}" role="button">Edit Service Details</a>
            <a class="btn btn-outline-primary btn-sm" href="#" role="button">Add Service Review</a>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/services') }}" role="button">Back</a>
        </div>
    </div>
</div>
@endsection
