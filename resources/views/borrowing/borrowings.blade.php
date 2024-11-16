@extends('layout.body')
@section('title', $title)
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>{{ $bc1 }}</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $bc1 }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <a href="{{ route('ruangan.form', ['param' => 'add', 'id' => Crypt::encrypt('null')]) }}"
                        class="btn btn-sm btn-primary"><i class="micon bi bi-person-plus"></i> Add
                    </a>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="table-plus datatable-nosort">Ruangan</th>
                                <th>Peminjam</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="table-plus">P-097878</td>
                                <td>Muhammad Syahdana, S.Kom</td>
                                <td>1 Hari</td>
                                <td>
                                    <span class="badge bg-warning">Peminjaman</span>
                                </td>
                                <td>{{ date('d-m-Y') }}</td>
                                <td>{{ date('d-m-Y') }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item" href="#">
                                                <i class="dw dw-eye"></i> View
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="dw dw-print"></i> Print
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="dw dw-edit2"></i> Edit
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="dw dw-delete-3"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->
            <div class="footer-wrap pd-20 mb-20 card-box">
                Copyright &copy; @SIMI
                <a href="https://github.com/dropways" style="text-decoration: none;" target="_blank">Qori Chairawan,
                    S.Kom</a>
            </div>
        </div>
    </div>
@endsection
