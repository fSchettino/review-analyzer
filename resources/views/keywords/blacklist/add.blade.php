@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Add Keyword to Blacklist
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-primary float-right" href="{{ url('/blacklist') }}" role="button">Back</a>
        </div>
    </div>
    <!-- Start add form -->
    <div class="row margin-top-20">
        <div class="col-md-8 col-sm-12">
            <form method="post" action="{{ url('/blacklistKey') }}">
            @csrf
                <div class="form-group">
                    <label for="name">Keyword name</label>
                    <input type="text" class="form-control" placeholder="e.g. bad" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="weight">Keyword weight</label>
                    <select class="form-control" id="weight" name="weight">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <!-- End add form -->
</div>
@endsection
