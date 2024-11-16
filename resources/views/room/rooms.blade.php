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
                                <th>Kode Ruangan</th>
                                <th>Keterangan</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($rooms as $item)
                                <tr>
                                    <td>1</td>
                                    <td class="table-plus">{{ $item->ruangan }}</td>
                                    <td>{{ $item->kode_ruangan }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item"
                                                    href="{{ route('ruangan.form', ['param' => 'edit', 'id' => Crypt::encrypt($item->id)]) }}">
                                                    <i class="dw dw-edit2"></i> Edit
                                                </a>
                                                <a class="dropdown-item btn-delete" href="#" data-toggle="modal"
                                                    type="button" data-target="#confirmation-modal"
                                                    data-id="{{ Crypt::encrypt($item->id) }}"
                                                    onclick="addItemDelete(this)">
                                                    <i class="dw dw-delete-3"></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center font-18">
                            <h4 class="padding-top-30">
                                Yakin ingin menghapus data ini ?
                            </h4>
                            <small>Data yang dihapus tidak dapat dikembalikan !</small>
                            <form action="{{ route('pengguna.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" required readonly placeholder="ID...."
                                        value="" name="id" id="itemID">
                                </div>
                                <div class="padding-bottom-30 mt-3 row">
                                    <div class="col">
                                        <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">
                                            Batalkan <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-danger btn-block">
                                            Ya, Hapus <i class="fa fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Simple Datatable End -->
            <div class="footer-wrap pd-20 mb-20 card-box">
                Copyright &copy; @SIMI
                <a href="#" style="text-decoration: none;" target="_blank">Qori Chairawan,
                    S.Kom</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function addItemDelete(element) {
            let dataId = element.getAttribute('data-id');
            let deleteForm = document.getElementById('itemID');
            deleteForm.value = dataId;
        }
    </script>
@endsection
