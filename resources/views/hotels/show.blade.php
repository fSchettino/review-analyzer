@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Hotel Details
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/hotels') }}" role="button">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <form method="get" action="{{ url('/review/hotel', $hotel['id']) }}">
                <input type="hidden" class="form-control" id="hotelId" name="hotelId" value="{{ $hotel['id'] }}">
                <a class="btn btn-outline-primary btn-sm" href="{{ url('/hotel/edit', $hotel['id']) }}" role="button">Edit Hotel Details</a>
                <button type="submit" class="btn btn-outline-primary btn-sm">Add Hotel Review</button>
            </form>
        </div>
    </div>
    <div class="row margin-top-30">
        <dl class="col-md-8 no-sides-padding">
            <dt class="col-md-8">Name</dt>
            <dd class="col-md-8">{{ $hotel['name'] }}</dd>
            <dt class="col-md-8">Description</dt>
            <dd class="col-md-12">{{ $hotel['description'] }}</dd>
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
        <br>
        <!-- Start hotel reviews list -->
        <div class="col-md-8 margin-top-30">
            @if (count($hotel['reviews']) != 0)
                <h3>
                    Hotel Reviews
                </h3>
                <br>
                @foreach($hotel['reviews'] as $hotelReview)
                    <dl class="row">
                        <dt class="col-md-8">Title</dt>
                        <dd class="col-md-8">{{ $hotelReview['title'] }}</dd>
                        <dt class="col-md-8">Description</dt>
                        <dd class="col-md-8">{{ $hotelReview['description'] }}</dd>
                        <dt class="col-md-8">Review score</dt>
                        <dd class="col-md-8">{{ $hotelReview['score'] }}</dd>
                    </dl>
                    <a class="btn btn-outline-primary btn-sm" href="{{ url('/review/delete', $hotelReview['id']) }}" role="button">Delete Review</a>
                    <hr>
                @endforeach
            @endif
        </div>
        <br>
        <!-- End hotel services list -->
    </div>
</div>
@endsection
