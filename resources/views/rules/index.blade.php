@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Rules List
            </h1>
        </div>
        <div class="col-md-4">
            <a class="btn btn-outline-primary float-right" href="{{ url('/rule') }}" role="button">Add rule</a>
        </div>
    </div>
    <div class="row margin-top-30">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Rule name</th>
                        <th scope="col">Service</th>
                        <th scope="col">keywords</th>
                        <th scope="col" colspan="2" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rules as $rule)
                    <tr>
                        <td>{{ $rule['id'] }}</td>
                        <td>{{ $rule['name'] }}</td>
                        <td>{{ $rule->service['name'] }}</td>
                        <td>
                            @foreach($rule['keywords'] as $keyword)
                                <li>{{ $keyword['name'] }}</li>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ url('/rule/edit', $rule['id']) }}"><i class="fas fa-edit"></i> Edit</a>
                        </td>
                        <td>
                            <a href="{{ url('/rule/delete', $rule['id']) }}"><i class="fas fa-trash-alt"></i> Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection