@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Add Service
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/services') }}" role="button">Back</a>
        </div>
    </div>
    <!-- Start add form -->
    <div class="row margin-top-30">
        <div class="col-md-8 col-sm-12">
            <form method="post" action="{{ url('/service') }}">
            @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="e.g. Swimming pool" id="name" name="name">
                </div>
                <a class="btn btn-outline-primary" href="{{ url('/services') }}" role="button">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <!-- End add form -->
</div>
@endsection
