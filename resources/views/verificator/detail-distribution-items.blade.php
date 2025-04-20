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
                                <li class="breadcrumb-item">
                                    {{ $bc1 }}
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $bc2 }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card card-box mb-30">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td colspan="4">
                                    <h5>Informasi Pendistribusian Barang</h5>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Kode</td>
                                <td colspan="3">{{ $distributionItem->kode_distribusi }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Bast</td>
                                <td colspan="3">{{ $distributionItem->nomor_bast }}</td>
                            </tr>
                            <tr>
                                <td>Ruangan</td>
                                <td colspan="3">
                                    @foreach ($distributionItem->rooms as $room)
                                        {{ $room->ruangan }}
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td colspan="3">{{ $distributionItem->keterangan }}</td>
                            </tr>
                            @if ($distributionItem->status == 'Selesai')
                                @php
                                    $bgcolor = 'success';
                                @endphp
                            @elseif($distributionItem->status == 'Pengajuan')
                                @php
                                    $bgcolor = 'warning';
                                @endphp
                            @elseif($distributionItem->status == 'Pratinjau')
                                @php
                                    $bgcolor = 'primary';
                                @endphp
                            @endif
                            <tr>
                                <td>Status Pengajuan</td>
                                <td colspan="3"><span class="badge text-white bg-{{ $bgcolor }}">
                                        {{ $distributionItem->status }}
                                    </span></td>
                            </tr>
                            <tr>
                                <td>Di-input Oleh</td>
                                <td colspan="3">{{ $user->name }} ({{ $user->email }}) | Timestamp :
                                    {{ $distributionItem->created_at }}</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">Catatan Verifikator</td>
                                <td colspan="3">
                                    @if ($verification)
                                        @if ($verification->status == 'Disetujui')
                                            @php
                                                $bgcolor = 'success';
                                            @endphp
                                        @elseif($verification->status == 'Ditolak')
                                            @php
                                                $bgcolor = 'danger';
                                            @endphp
                                        @endif

                                        <p>{{ $verification->keterangan }}</p>
                                        <span class="text-white badge bg-{{ $bgcolor }}">Verifikasi :
                                            {{ $verification->status }}</span>
                                        | Verifikator : {{ $verifikator->name }} | Timestamp :
                                        {{ $verification->updated_at }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <h5>List Distribusi Barang</h5>
                                </td>
                            </tr>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                            @foreach ($listDistributionItems->get() as $listDistributionItem)
                                <tr>
                                    <td>{{ $listDistributionItem->kode_barang }}</td>
                                    <td>{{ $listDistributionItem->items->nama_barang }}</td>
                                    <td>{{ $listDistributionItem->created_at }}</td>
                                    <td>{{ $listDistributionItem->updated_at }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item"
                                                    href="{{ route('barang.detail', ['id' => Crypt::encrypt($listDistributionItem->items->id)]) }}">
                                                    <i class="dw dw-eye"></i> View
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-delete" data-toggle="modal"
                        type="button" data-target="#confirmation-modal"
                        data-id="{{ Crypt::encrypt($distributionItem->id) }}" onclick="addItemDelete(this)">
                        <i class="icon-copy bi bi-check-circle"></i> Verifikasi
                    </a>
                </div>
            </div>

            <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body font-18">
                            <h4 class="padding-top-30 text-center">
                                Yakin ingin memverifikasi data ini ?
                            </h4>
                            <div class="text-center mb-5">
                                <small>
                                    Pastikan data yang ingin ada verifikasi adalah data yang valid !
                                </small>
                            </div>
                            <form action="{{ route('verifikator.change-verified') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" required readonly placeholder="ID...."
                                        value="" name="id" id="itemID">
                                </div>
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" required readonly placeholder="type"
                                        value="distribution" name="type" id="type">
                                </div>
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" required readonly placeholder="ID...."
                                        value="{{ Crypt::encrypt($distributionItem->verifikasi_id) }}" name="idVerifikasi"
                                        id="verificationID">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status Verifikasi <span class="text-danger">*</span></label>
                                    <select name="status" id="status" required class="form-control">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Disetujui" @if ($verification && $verification->status == 'Disetujui') selected @endif>
                                            Disetujui
                                        </option>
                                        <option value="Ditolak" @if ($verification && $verification->status == 'Ditolak') selected @endif>Ditolak
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan <span class="text-danger">*</span></label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" required autocomplete="off" cols="30"
                                        rows="10">
                                        @if ($verification)
{{ $verification->keterangan }}
@endif
                                    </textarea>
                                </div>
                                <div class="padding-bottom-30 mt-3 row">
                                    <div class="col">
                                        <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">
                                            Batal <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Simpan <i class="fa fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
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
    <script type="text/javascript">
        function addItemDelete(element) {
            let dataId = element.getAttribute('data-id');
            let deleteForm = document.getElementById('itemID');
            deleteForm.value = dataId;
        }
    </script>
@endsection
