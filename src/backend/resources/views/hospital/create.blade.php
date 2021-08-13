@extends('layouts.app')
@section('content')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Hospital</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('hospital.index') }}">Hospital</a></li>
                <li class="breadcrumb-item active">Create Hospital</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">Create Hospital and User Informations</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('hospital.store') }}">
                    @csrf
                    <div class="form-body">
                        <div class="row p-t-20">
                            <div class="col-md-6">
                                <h3 class="card-title">Hospital Info</h3>
                                <hr>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Hospital Name">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Hospital Address">
                                </div>
                                <div class="form-group">
                                    <label for="phone_num">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone_num" name="phone_num" placeholder="09123456789">
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input class="form-control mydatepicker" id="date" name="start_date" placeholder="dd-mm-yy">
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input class="form-control mydatepicker" id="date" name="end_date" placeholder="dd-mm-yy">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="card-title">User Info</h3>
                                <hr>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="username" placeholder="Enter User Name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="example@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label for="email">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success mr-2">Create</button>
                        <button type="submit" class="btn btn-dark">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        // Date Picker
        jQuery('.mydatepicker').datepicker({ format: 'dd/mm/yyyy' });
    </script>
@endpush
@endsection