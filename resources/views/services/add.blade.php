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
                    <label for="name">Service name</label>
                    <input type="text" class="form-control" placeholder="e.g. bad" id="name" name="name">
                </div>
                <br>
                <h3>
                    Select Service Review analysis keywords
                </h3>
                <!-- Start whitelist keywords selector -->
                <div class="form-group col-md-4 no-sides-padding margin-top-30">
                    <label for="whitelistKeywords">Whitelist Keywords</label>
                    <select multiple class="form-control" id="whitelistKeywords" name="whitelistKeywords">
                    @foreach($whitelistKeywords as $whitelistKeyword)
                        <option value="{{ $whitelistKeyword['name'] }}" name="{{ $whitelistKeyword['name'] }}">{{ $whitelistKeyword['name'] }}</option>
                    @endforeach
                    </select>
                </div>
                <!-- End whitelist keywords selector -->
                <!-- Start blacklist keywords selector -->
                <div class="form-group col-md-4 no-sides-padding margin-top-30">
                    <label for="blacklistKeywords">Blacklist Keywords</label>
                    <select multiple class="form-control" id="blacklistKeywords" name="blacklistKeywords">
                    @foreach($blacklistKeywords as $blacklistKeyword)
                        <option value="{{ $blacklistKeyword['name'] }}" name="{{ $blacklistKeyword['name'] }}">{{ $blacklistKeyword['name'] }}</option>
                    @endforeach
                    </select>
                </div>
                <!-- End blacklist keywords selector -->
                <a class="btn btn-outline-primary" href="{{ url('/services') }}" role="button">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <!-- End add form -->
</div>
@endsection
