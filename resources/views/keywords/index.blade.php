@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Keywords
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/keyword') }}" role="button">Add keyword</a>
        </div>
    </div>
    <div class="row margin-top-30">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Type</th>
                        <th scope="col">Name</th>
                        <th scope="col">Weight</th>
                        <th scope="col" colspan="2" class="text-center">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keywords as $keyword)
                    @if ($keyword['type'] == 'positive')
                    <tr class="table-success">
                    @else
                    <tr class="table-danger">
                    @endif
                        <td>{{ $keyword['id'] }}</td>
                        <td>{{ $keyword['type'] }}</td>
                        <td>{{ $keyword['name'] }}</td>
                        <td>{{ $keyword['weight'] }}</td>
                        <td>
                            <a href="{{ url('/keyword/edit', $keyword['id']) }}"><i class="fas fa-edit"></i> Edit</a>
                        </td>
                        <td>
                            <a href="{{ url('/keyword/delete', $keyword['id']) }}"><i class="fas fa-trash-alt"></i> Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
