@extends('sharedView::layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Edit Rule: "{{ $rule['name'] }}"
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/rules') }}" role="button">Back</a>
        </div>
    </div>
    <!-- Start add form -->
    <div class="row margin-top-30">
        <div class="col-md-8 col-sm-12">
            <form method="post" action="{{ url('/rule/edit', $rule['id']) }}">
            @csrf
                <div class="form-group">
                    <label for="name">Rule name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $rule['name'] }}" required>
                </div>
                <br>
                <h3>
                    Select Service
                </h3>
                <!-- Start services list -->
                <div class="form-group">
                    <label for="service">Service</label>
                    <select class="form-control" id="service" name="service">
                    @foreach($services as $service)
                        @if ($rule->service['name'] == $service->name)
                            <option value="{{ $service['id'] }}" selected>{{ $service['name'] }}</option>
                        @else
                            <option value="{{ $service['id'] }}">{{ $service['name'] }}</option>
                        @endif
                    @endforeach
                    </select>
                </div>
                <!-- End services list -->
                <br>
                <h3>
                    Select Rule keywords
                </h3>
                <!-- Start positive keywords selector -->
                <div class="form-group col-md-4 no-sides-padding margin-top-30">
                    <label for="positiveKeywords">Positive Keywords</label>
                    <select multiple class="form-control" id="positiveKeywords" name="positiveKeywords[]">
                    @foreach($positiveKeywords as $positiveKeyword)
                        <option value="{{ $positiveKeyword['id'] }}" name="{{ $positiveKeyword['name'] }}" @foreach ($rule['keywords'] as $ruleKyeword) @if ($ruleKyeword['name'] == $positiveKeyword['name']) selected @endif @endforeach>{{ $positiveKeyword['name'] }}</option>
                    @endforeach
                    </select>
                </div>
                <!-- End positive keywords selector -->
                <!-- Start negative keywords selector -->
                <div class="form-group col-md-4 no-sides-padding margin-top-30">
                    <label for="negativeKeywords">Negative Keywords</label>
                    <select multiple class="form-control" id="negativeKeywords" name="negativeKeywords[]">
                    @foreach($negativeKeywords as $negativeKeyword)
                        <option value="{{ $negativeKeyword['id'] }}" name="{{ $negativeKeyword['name'] }}" @foreach ($rule['keywords'] as $ruleKyeword) @if ($ruleKyeword['name'] == $negativeKeyword['name']) selected @endif @endforeach>{{ $negativeKeyword['name'] }}</option>
                    @endforeach
                    </select>
                </div>
                <!-- End negative keywords selector -->
                <a class="btn btn-outline-primary" href="{{ url('/rules') }}" role="button">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <!-- End add form -->
</div>
@endsection
