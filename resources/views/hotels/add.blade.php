@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Add Hotel
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/hotels') }}" role="button">Back</a>
        </div>
    </div>
    <!-- Start add form -->
    <div class="row margin-top-20">
        <div class="col-md-8 col-sm-12">
            <form method="post" action="{{ url('/hotel') }}">
            @csrf
                <div class="form-group">
                    <label for="name">Hotel name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="description">Hotel description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="rooms">Rooms</label>
                    <input type="number" min="1" class="form-control col-md-2" id="rooms" name="rooms">
                </div>
                <br>
                <!-- Start hotel services list -->
                <h3>
                    Select Hotel Services
                </h3>
                <div class="form-group margin-top-20">
                    @foreach($services as $service)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="{{ $service['id'] }}" id="{{ $service['id'] }}">
                        <label class="form-check-label" for="{{ $service['id'] }}">
                            {{ $service['name'] }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <br>
                <!-- End hotel services list -->
                <h3>
                    Select Hotel Review analysis keywords
                </h3>
                <!-- Start whitelist keywords selector -->
                <div class="form-group col-md-4 no-sides-padding margin-top-20">
                    <label for="whitelistKeywords">Whitelist Keywords</label>
                    <select multiple class="form-control" id="whitelistKeywords" name="whitelistKeywords">
                    @foreach($whitelistKeywords as $whitelistKeyword)
                        <option value="{{ $whitelistKeyword['name'] }}" name="{{ $whitelistKeyword['name'] }}">{{ $whitelistKeyword['name'] }}</option>
                    @endforeach
                    </select>
                </div>
                <!-- End whitelist keywords selector -->
                <!-- Start blacklist keywords selector -->
                <div class="form-group col-md-4 no-sides-padding margin-top-20">
                    <label for="blacklistKeywords">Blacklist Keywords</label>
                    <select multiple class="form-control" id="blacklistKeywords" name="blacklistKeywords">
                    @foreach($blacklistKeywords as $blacklistKeyword)
                        <option value="{{ $blacklistKeyword['name'] }}" name="{{ $blacklistKeyword['name'] }}">{{ $blacklistKeyword['name'] }}</option>
                    @endforeach
                    </select>
                </div>
                <!-- End blacklist keywords selector -->
                <a class="btn btn-outline-primary" href="{{ url('/hotels') }}" role="button">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <!-- End add form -->
</div>
@endsection
