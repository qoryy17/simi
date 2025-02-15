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
                                    <h5>Informasi Pendataan Barang</h5>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <img class="img img-fluid" src="{{ asset('storage/' . $item->file_image) }}"
                                        alt="Gambar {{ $item->nama_barang }}">
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Kode</td>
                                <td colspan="3">{{ $item->kode_barang }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td colspan="3">{{ $item->nama_barang }}</td>
                            </tr>
                            <tr>
                                <td>Jenis</td>
                                <td colspan="3">{{ $item->jenis }}</td>
                            </tr>
                            <tr>
                                <td>Merek</td>
                                <td>{{ $item->merek }}</td>
                                <td width="2%">Tipe</td>
                                <td>{{ $item->tipe }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Seri</td>
                                <td colspan="3">{{ $item->nomor_seri }}</td>
                            </tr>
                            <tr>
                                <td>Ukuran</td>
                                <td colspan="3">{{ $item->ukuran }}</td>
                            </tr>
                            <tr>
                                <td>Bahan</td>
                                <td colspan="3">{{ $item->bahan }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah</td>
                                <td colspan="3">{{ $item->jumlah }} {{ $unitItem->satuan }}</td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td colspan="3">Rp.{{ Number::Format($item->harga, 0) }}</td>
                            </tr>
                            <tr>
                                <td>Total Harga </td>
                                <td colspan="3">
                                    Rp.{{ Number::Format(intval($item->jumlah) * intval($item->harga), 0) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Sumber Dana</td>
                                <td colspan="3">{{ $item->sumber_dana }}</td>
                            </tr>
                            <tr>
                                <td>Kondisi</td>
                                <td colspan="3">{{ $conditionItem->kondisi }}</td>
                            </tr>
                            <tr>
                                <td>Tahun Pengadaan</td>
                                <td colspan="3">{{ $item->tahun_pengadaan }}</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">Informasi Kontrak</td>
                                <td colspan="3">
                                    Nomor ({{ $item->nomor_kontrak }})
                                    <br>
                                    Tanggal
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_kontrak)->format('d F Y') }}
                                    <br>
                                    <a target="_BLANK" href="{{ asset('storage/' . $item->file_edoc) }}"
                                        title="Lihat Kontrak">
                                        <i class="icon-copy bi bi-eye"></i>
                                        Lihat Kontrak
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Di-input Oleh</td>
                                <td colspan="3">{{ $user->name }} ({{ $user->email }}) | Timestamp :
                                    {{ $item->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Status Pengajuan</td>
                                <td colspan="3">
                                    @if ($item->status == 'Pratinjau')
                                        @php
                                            $color = 'warning';
                                        @endphp
                                    @elseif ($item->status == 'Pengajuan')
                                        @php
                                            $color = 'primary';
                                        @endphp
                                    @elseif ($item->status == 'Selesai')
                                        @php
                                            $color = 'success';
                                        @endphp
                                    @endif
                                    <span class="badge bg-{{ $color }} text-white">
                                        {{ $item->status }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td colspan="3">{{ $item->keterangan }}</td>
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
                        type="button" data-target="#confirmation-modal" data-id="{{ Crypt::encrypt($item->id) }}"
                        onclick="addItemDelete(this)">
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
                                    <input type="text" class="form-control" required readonly placeholder="ID...."
                                        value="{{ Crypt::encrypt($item->verifikasi_id) }}" name="idVerifikasi"
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
