@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Add a review for: "{{ $hotel['name'] }}"
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/hotels') }}" role="button">Back</a>
        </div>
    </div>
    <!-- Start add form -->
    <div class="row margin-top-30">
        <div class="col-md-8 col-sm-12">
            <form method="post" action="{{ url('/review/hotel', $hotel['id']) }}">
            @csrf
            <input type="hidden" class="form-control" id="hotelId" name="hotelId" value="{{ $hotel['id'] }}">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Review</label>
                    <textarea class="form-control" id="description" name="description" rows="10" required></textarea>
                </div>
                <a class="btn btn-outline-primary" href="{{ url('/hotels') }}" role="button">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <!-- End add form -->
</div>
@endsection
