@extends('admin.layout.app')

@section('title','Dashboard')

@section('content')

<div class="row">

    <div class="col-12">
        <div class="mb-6">
            <h1 class="fs-3 mb-1">Dashboard</h1>
            <p>Your main content goes here…</p>
        </div>
    </div>

</div>

<div class="row g-3 mb-3">

    <div class="col-lg-3 col-12">

        <div class="card p-4 bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded-2">

            <div class="d-flex gap-3">

                <div class="icon-shape icon-md bg-primary text-white rounded-2">
                    <i class="ti ti-report-analytics fs-4"></i>
                </div>

                <div>
                    <h2 class="mb-3 fs-6">Total Sales</h2>
                    <h3 class="fw-bold mb-0">$25,000</h3>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
