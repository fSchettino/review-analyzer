@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Hotels List
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-primary float-right" href="{{ url('/hotel') }}" role="button">Add hotel</a>
        </div>
    </div>
    <div class="row margin-top-20">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Hotel name</th>
                        <th scope="col">Avg Score</th>
                        <th scope="col" colspan="2" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hotels as $hotel)
                    <tr>
                        <td>{{ $hotel["id"] }}</td>
                        <td>{{ $hotel["name"] }}</td>
                        <td>{{ $hotel["avgScore"] }}</td>
                        <td>
                            <a href="#"><i class="fas fa-eye"></i> View</a>
                        </td>
                        <td>
                            <a href="#"><i class="fas fa-trash-alt"></i> Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
