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
                <li class="breadcrumb-item active">Hospital</li>
                <li class="breadcrumb-item">Edit Hospital</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-body">
            <h4 class="card-title">Edit Hospital</h4>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form action="{{ route('hospital.update', $hospital->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$hospital->name}}">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{$hospital->address}}">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_num" value="{{$hospital->phone_num}}">
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input class="form-control mydatepicker" id="date" name="start_date" value="{{$hospital->start_date}}">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input class="form-control mydatepicker" id="date" name="end_date" value="{{$hospital->end_date}}">
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Update</button>
                        <button type="submit" class="btn btn-dark">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection