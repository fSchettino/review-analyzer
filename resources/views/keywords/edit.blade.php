@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Update Keyword: "{{ $keyword['name'] }}"
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/keywords') }}" role="button">Back</a>
        </div>
    </div>
    <!-- Start add form -->
    <div class="row margin-top-30">
        <div class="col-md-8 col-sm-12">
            <form method="post" action="{{ url('/keyword/edit', $keyword['id']) }}">
            @csrf
                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" id="type" name="type">
                                <option value="positive" @if ($keyword['type'] == 'positive') selected @endif>positive</option>
                                <option value="negative" @if ($keyword['type'] == 'negative') selected @endif>negative</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="e.g. good" id="name" name="name" value="{{ $keyword['name'] }}" required>
                </div>
                <div class="form-group">
                    <label for="weight">Weight</label>
                    <select class="form-control" id="weight" name="weight">
                        @for ($i = 1; $i < 4; $i++)
                            @if ($keyword['weight'] == $i)
                                <option value="{{ $i }}" selected>{{ $i }}</option>
                            @else
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endif
                        @endfor
                    </select>
                </div>
                <a class="btn btn-outline-primary" href="{{ url('/keywords') }}" role="button">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <!-- End add form -->
</div>
@endsection
