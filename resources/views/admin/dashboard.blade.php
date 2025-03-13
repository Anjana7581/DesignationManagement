@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <!-- Total Designations Card -->
        <div class="col-md-3">
            <div class="card card-primary">
                <div class="card-header">Total Designations</div>
                <div class="card-body">
                    <h3>{{ $totalDesignations }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="col-md-3">
            <div class="card card-success">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h3>{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>

        <!-- Active Users Card -->
        <div class="col-md-3">
            <div class="card card-info">
                <div class="card-header">Active Users</div>
                <div class="card-body">
                    <h3>{{ $activeUsers }}</h3>
                </div>
            </div>
        </div>

        <!-- Inactive Users Card -->
        <div class="col-md-3">
            <div class="card card-danger">
                <div class="card-header">Inactive Users</div>
                <div class="card-body">
                    <h3>{{ $inactiveUsers }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
