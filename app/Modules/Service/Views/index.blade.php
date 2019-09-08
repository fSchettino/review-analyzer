@extends('sharedView::layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Services List
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/service') }}" role="button">Add service</a>
        </div>
    </div>
    <div class="row margin-top-30">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Service name</th>
                        <th scope="col" colspan="2" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{ $service['id'] }}</td>
                        <td>{{ $service['name'] }}</td>
                        <td>
                            <a href="{{ url('/service/edit', $service['id']) }}"><i class="fas fa-edit"></i> Edit</a>
                        </td>
                        <td>
                            <a href="{{ url('/service/delete', $service['id']) }}"><i class="fas fa-trash-alt"></i> Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
