@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Update Blacklist Keyword: "{{ $blacklistKeyword['name'] }}"
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/blacklist') }}" role="button">Back</a>
        </div>
    </div>
    <!-- Start add form -->
    <div class="row margin-top-30">
        <div class="col-md-8 col-sm-12">
            <form method="post" action="{{ url('/blacklistKey/edit', $blacklistKeyword['id']) }}">
            @csrf
                <div class="form-group">
                    <label for="name">Keyword name</label>
                    <input type="text" class="form-control" placeholder="e.g. good" id="name" name="name" value="{{ $blacklistKeyword['name'] }}">
                </div>
                <div class="form-group">
                    <label for="weight">Keyword weight</label>
                    <select class="form-control" id="weight" name="weight">
                        @for ($i = 1; $i < 4; $i++)
                            @if ($blacklistKeyword['weight'] == $i)
                                <option value="-{{ $i }}" selected>-{{ $i }}</option>
                            @else
                                <option value="-{{ $i }}">-{{ $i }}</option>
                            @endif
                        @endfor
                    </select>
                </div>
                <a class="btn btn-outline-primary" href="{{ url('/blacklist') }}" role="button">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    <!-- End add form -->
</div>
@endsection
