@extends('layouts.app')

@section('title', 'Dashboard - TB JWP')

@section('page-header')
<div class="iq-navbar-header" style="height: 215px;">
    <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">
                <div class="flex-wrap d-flex justify-content-between align-items-center">
                    <div class="text-white">
                        <h1>Halo, Selamat Datang!</h1>
                        <p>Sistem Informasi Persediaan Barang Toko Bangunan JWP.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="iq-header-img">
        <img src="{{ asset('hope-ui/assets/images/dashboard/top-header.png') }}" alt="header" class="theme-color-default-img img-fluid w-100 h-100 object-cover">
    </div>
</div>
@endsection

@section('content')
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5>Ringkasan Sistem</h5>
                    <p class="mb-0">Silakan gunakan menu di sebelah kiri untuk mengelola kategori barang, daftar barang, atau melihat laporan persediaan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection