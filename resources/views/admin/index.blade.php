@extends('layouts.admin')
@section('title', ' الصفحة الرئيسية')
@section('main_title_content', ' الصفحة الرئيسية')
@section('title_content', 'عرض')
@section('link_content')
    <a href="{{ route('dashboard') }}"> الصفحة الرئيسية</a>
@endsection

@section('content')

    @if (Auth::user()->role == 'manager' || Auth::user()->role == 'guide')
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ count($users) }}</h3>

                        <p>عدد المستخدمين</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    {{-- <a href="{{ route('user.index') }}" class="small-box-footer">
                        المستخدمين <i class="fas fa-arrow-circle-right"></i>
                    </a> --}}
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ count($students) }}</h3>

                        <p> عدد الاساتذه</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    {{-- <a href="{{ route('client.index') }}" class="small-box-footer">
                        الموكلين <i class="fas fa-arrow-circle-right"></i>
                    </a> --}}
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ count($students) }}</h3>

                        <p> عدد الطلاب</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    {{-- <a href="{{ route('client.index') }}" class="small-box-footer">
                        الموكلين <i class="fas fa-arrow-circle-right"></i>
                    </a> --}}
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ count($guides) }}</h3>

                        <p>عدد الموجهبين </p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    {{-- <a href="{{ route('request.index') }}" class="small-box-footer">
                        طلبات الموكلين <i class="fas fa-arrow-circle-right"></i>
                    </a> --}}
                </div>
            </div>
        </div>
    @endif

@endsection
