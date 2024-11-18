@extends('layout.body')
@section('title', $title)
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>SIMI <small>{{ env('APP_NAME_DESCRIPTION_ID') }}</small></h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $page }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">75</div>
                                <div class="font-14 text-secondary weight-500">
                                    Barang Masuk Tahun 2024
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#fff" style="color: #fff;">
                                    <i class="micon bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">75</div>
                                <div class="font-14 text-secondary weight-500">
                                    Peminjaman Tahun 2024
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#fff" style="color: #fff;">
                                    <i class="micon bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-20">
                    <div class="card-box height-100-p widget-style3">
                        <div class="d-flex flex-wrap">
                            <div class="widget-data">
                                <div class="weight-700 font-24 text-dark">75</div>
                                <div class="font-14 text-secondary weight-500">
                                    Pendistribusian Tahun 2024
                                </div>
                            </div>
                            <div class="widget-icon">
                                <div class="icon" data-color="#fff" style="color: #fff;">
                                    <i class="micon bi-person"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-20">
                    <div class="card-box height-100-p pd-20 min-height-200px">
                        <div class="d-flex justify-content-between pb-10">
                            <div class="h5 mb-0">Peminjaman Saat Ini</div>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    data-color="#1b3133" href="#" role="button" data-toggle="dropdown"
                                    style="color: rgb(27, 49, 51);" aria-expanded="false">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list" style="">
                                    <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> Lihat</a>
                                </div>
                            </div>
                        </div>
                        <div class="user-list">
                            <ul>
                                <li class="d-flex align-items-center justify-content-between">
                                    <div class="name-avatar d-flex align-items-center pr-2">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <img src="{{ asset('resources/vendors/images/photo1.jpg') }}"
                                                class="border-radius-100 box-shadow" width="50" height="50"
                                                alt="">
                                        </div>
                                        <div class="txt">
                                            <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                                data-color="#265ed7"
                                                style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">4.9</span>
                                            <div class="font-14 weight-600">Dr. Neil Wagner</div>
                                            <div class="font-12 weight-500" data-color="#b2b1b6"
                                                style="color: rgb(178, 177, 182);">
                                                Pediatrician
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cta flex-shrink-0">
                                        <a href="#" class="btn btn-sm btn-outline-primary">Selesai</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <div class="name-avatar d-flex align-items-center pr-2">
                                        <div class="avatar mr-2 flex-shrink-0">
                                            <img src="{{ asset('resources/vendors/images/photo1.jpg') }}"
                                                class="border-radius-100 box-shadow" width="50" height="50"
                                                alt="">
                                        </div>
                                        <div class="txt">
                                            <span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5"
                                                data-color="#265ed7"
                                                style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);">4.9</span>
                                            <div class="font-14 weight-600">Dr. Neil Wagner</div>
                                            <div class="font-12 weight-500" data-color="#b2b1b6"
                                                style="color: rgb(178, 177, 182);">
                                                Pediatrician
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cta flex-shrink-0">
                                        <a href="#" class="btn btn-sm btn-outline-primary">Selesai</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 mb-20">
                    <div class="card-box height-100-p pd-20 min-height-200px">
                        <div class="d-flex justify-content-between pb-10">
                            <div class="h5 mb-0">Verifikasi Pendataan</div>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                    data-color="#1b3133" href="#" role="button" data-toggle="dropdown"
                                    style="color: rgb(27, 49, 51);" aria-expanded="false">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list" style="">
                                    <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> Lihat</a>
                                </div>
                            </div>
                        </div>
                        <div class="user-list">
                            <ul>
                                <li class="d-flex align-items-center justify-content-between">
                                    <div class="name-avatar d-flex align-items-center pr-2">
                                        <div class="txt">
                                            <div class="font-14 weight-600">Lenovo AIO 2023</div>
                                            <div class="font-12 weight-500" data-color="#FF9900" style="color: #FF9900;">
                                                Menunggu Verifikasi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cta flex-shrink-0">
                                        <a href="#" class="btn btn-sm btn-outline-secondary">Detail</a>
                                    </div>
                                </li>
                                <li class="d-flex align-items-center justify-content-between">
                                    <div class="name-avatar d-flex align-items-center pr-2">
                                        <div class="txt">
                                            <div class="font-14 weight-600">Server Lenovo V203 Intel Xeon 224.5G</div>
                                            <div class="font-12 weight-500" data-color="#FF9900" style="color: #FF9900;">
                                                Menunggu Verifikasi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cta flex-shrink-0">
                                        <a href="#" class="btn btn-sm btn-outline-secondary">Detail</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                Copyright &copy; {{ date('Y') }}
                <a href="" style="text-decoration: none;" target="_blank">
                    {{ env('APP_NAME') }} - {{ env('APP_NAME_DESCRIPTION') }}
                </a>
            </div>
        </div>
    </div>
@endsection
