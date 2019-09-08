@extends('sharedView::layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Update Hotel: "{{ $hotel['name'] }}"
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/hotels') }}" role="button">Back</a>
        </div>
    </div>
    <!-- Start add form -->
    <div class="row margin-top-30">
        <div class="col-md-8 col-sm-12">
            <form method="post" action="{{ url('/hotel/edit', $hotel['id']) }}">
            @csrf
                <div class="form-group">
                    <label for="name">Hotel name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $hotel['name'] }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Hotel description</label>
                    <textarea class="form-control" id="description" name="description" rows="10" required>{{ $hotel['description'] }}</textarea>
                </div>
                <div class="form-group">
                    <label for="rooms">Rooms</label>
                    <input type="number" min="1" class="form-control col-md-2" id="rooms" name="rooms" value="{{ $hotel['rooms'] }}" required>
                </div>
                <br>
                <!-- Start hotel services list -->
                <h3>
                    Select Hotel Services
                </h3>
                <div class="form-group margin-top-30">
                    @foreach($services as $service)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" value="{{ $service['id'] }}" id="{{ $service['id'] }}" name="services[]" @foreach ($hotel['services'] as $hotelService) @if ($hotelService['name'] == $service['name']) checked @endif @endforeach>
                        <label class="form-check-label" for="{{ $service['id'] }}">
                            {{ $service['name'] }}
                        </label>
                    </div>
                    @endforeach
                </div>
                <br>
                <!-- End hotel services list -->
                <h3>
                    Select Hotel Review analysis rules
                </h3>
                <!-- Start whitelist keywords selector -->
                <div class="form-group col-md-4 no-sides-padding margin-top-30">
                    <label for="rules">Rules</label>
                    <select multiple class="form-control" id="rules" name="rules[]">
                    @foreach($rules as $rule)
                        <option value="{{ $rule['id'] }}" name="{{ $rule['name'] }}" @foreach ($hotel['rules'] as $hotelRule) @if ($hotelRule['name'] == $rule['name']) selected @endif @endforeach>{{ $rule['name'] }}</option>
                    @endforeach
                    </select>
                </div>
                <!-- End whitelist keywords selector -->
                <a class="btn btn-outline-primary" href="{{ url('/hotels') }}" role="button">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <!-- End add form -->
</div>
@endsection
