@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Hotel Details
            </h1>
            <a class="btn btn-outline-primary btn-sm" href="{{ url('/hotel/edit', $hotel['id']) }}" role="button">Edit Hotel Details</a>
            <a class="btn btn-outline-primary btn-sm" href="#" role="button">Add Hotel Review</a>
        </div>

        <dl class="col-md-8 margin-top-30 no-sides-padding">
            <dt class="col-md-8">Name</dt>
            <dd class="col-md-8">{{ $hotel['name'] }}</dd>
            <dt class="col-md-8">Description</dt>
            <dd class="col-md-8">{{ $hotel['description'] }}</dd>
            <dt class="col-md-8">Rooms</dt>
            <dd class="col-md-8">{{ $hotel['rooms'] }}</dd>
            <br>
            <dt class="col-md-8">Services</dt>
            <dd class="col-md-8">
                @foreach($hotel['services'] as $service)
                    <li>{{ $service['name'] }}</li>
                @endforeach
            </dd>
            <br>
            <dt class="col-md-8">Hotel Review analysis rules</dt>
            <dd class="col-md-8">
                @foreach($hotel['rules'] as $rule)
                    <li>{{ $rule['name'] }}</li>
                @endforeach
            </dd>
        </dl>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/hotels') }}" role="button">Back</a>
        </div>
    </div>
</div>
@endsection
