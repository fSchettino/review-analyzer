@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>
                Welcome to Review Analyzer
            </h1>
        </div>
    </div>
    <div class="row margin-top-20">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Hotel name</th>
                        <th scope="col">Avg Score</th>
                        <th scope="col" colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hotels as $info)
                            <td>{{info.name}}</td>
                            <td>Avarage score</td>
                            <td>Edit</td>
                            <td>Delete</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
