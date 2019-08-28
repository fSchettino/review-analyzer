@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>
                Keywords Blacklist
            </h1>
        </div>
    </div>
    <div class="row margin-top-20">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Key</th>
                        <th scope="col" colspan="2" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blackList as $key)
                    <tr>
                        <td>{{ $key }}</td>
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
