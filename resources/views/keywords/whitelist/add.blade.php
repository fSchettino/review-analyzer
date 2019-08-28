@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Add Keyword to Withelist
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-primary float-right" href="{{ url('/whitelist') }}" role="button">Back</a>
        </div>
    </div>
</div>
@endsection
