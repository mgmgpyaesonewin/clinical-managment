@extends('layouts.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Hospital</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('hospital.index') }}">Hospital</a></li>
                <li class="breadcrumb-item active">All Hospitals</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        @if(session()->get('success'))
            <div class="alert alert-success">
            {{ session()->get('success') }}  
            </div>
        @endif
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Hospitals</h4>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th class="text-nowrap">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hospitals as $hospital)
                            <tr>
                                <td>{{$hospital->name}}</td>
                                <td>{{$hospital->address}}</td>
                                <td>{{$hospital->phone_num}}</td>
                                <td>{{$hospital->start_date}}</td>
                                <td>{{$hospital->end_date}}</td>
                                <td class="text-nowrap">
                                    <a href="{{ route('hospital.edit', $hospital->id) }}"><button type="button" class="btn waves-effect waves-light btn-info"><i class="far fa-edit"></i> Edit</button></a> 
                                    <form style="display: inline" action="{{route('hospital.destroy', $hospital->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn waves-effect waves-light btn-danger"><i class=" fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $hospitals->links() }}
            </div>
        </div>
    </div>
</div>
@endsection