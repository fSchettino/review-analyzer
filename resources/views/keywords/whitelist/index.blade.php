@extends('layout.main') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>
                Whitelist Keywords
            </h1>
        </div>
        <div class="col-md-4">
            <a
                class="btn btn-primary float-right"
                href="{{ url('/whitelistKey') }}"
                role="button"
                >Add keyword</a
            >
        </div>
    </div>
    <div class="row margin-top-20">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Key</th>
                        <th scope="col" colspan="2" class="text-center">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($whiteList as $key)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>
                            <a href="#"><i class="fas fa-eye"></i> View</a>
                        </td>
                        <td>
                            <a href="#"
                                ><i class="fas fa-trash-alt"></i> Delete</a
                            >
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
