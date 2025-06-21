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
                    <a href="{{ route('peminjamanBarang.form', ['param' => 'add', 'id' => Crypt::encrypt('null')]) }}"
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
                            @forelse ($borrowingItems as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="table-plus">{{ $item->room->nama_ruangan }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->durasi }} Hari</td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            <span class="badge badge-warning">{{ $item->status }}</span>
                                        @elseif ($item->status == 'approved')
                                            <span class="badge badge-success">{{ $item->status }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>{{ $item->updated_at->format('d-m-Y H:i:s') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('peminjamanBarang.form', ['param' => 'update', 'id' => Crypt::encrypt($item->id)]) }}">Edit</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('peminjamanBarang.delete', ['id' => Crypt::encrypt($item->id)]) }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data tidak Ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->
            <div class="footer-wrap pd-20 mb-20 card-box">
                Copyright &copy; {{ date('Y') }}
                <a href="" style="text-decoration: none;" target="_blank">
                    {{ env('APP_NAME') }} - {{ env('APP_NAME_DESCRIPTION') }}
                </a>
            </div>
        </div>
    </div>
@endsection
