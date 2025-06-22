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
                    <form action="{{ route('peminjamanBarang.save') }}" method="POST">
                        @method('POST')
                        @csrf
                        @if ($borrowingItems && Crypt::decrypt($param) == 'update')
                            <div class="form-group" hidden>
                                <label for="id">
                                    ID
                                    <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" id="id" name="id" required autocomplete="off"
                                    type="text" placeholder="ID" value="{{ Crypt::encrypt($borrowingItems->id) }}"
                                    readonly />
                            </div>
                        @endif
                        <div class="form-group" hidden>
                            <label for="param">
                                Parameter
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="param" name="param" required autocomplete="off"
                                type="text" placeholder="Parameter" value="{{ $param }}" readonly />
                        </div>
                        <div class="form-group">
                            <label for="kode_peminjaman">
                                Kode Peminjaman
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="kode_peminjaman" name="kode_peminjaman" required
                                autocomplete="off" type="text" placeholder="Kode Peminjaman"
                                value="{{ $borrowingItems ? $borrowingItems->kode_peminjaman : old('kode_peminjaman') }}" />
                            @error('kode_peminjaman')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="durasi">
                                Durasi Peminjaman (Hari)
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" name="durasi"
                                value="{{ $borrowingItems ? $borrowingItems->durasi : old('durasi') }}" id="durasi"
                                required autocomplete="off" type="number" placeholder="Durasi.." />
                            @error('durasi')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggalPeminjaman">
                                Tanggal Peminjaman
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control date-picker" id="tanggalPeminjaman" name="tanggalPeminjaman" required
                                autocomplete="off" type="text" placeholder="Tanggal Peminjaman"
                                value="{{ $borrowingItems ? \Carbon\Carbon::createFromFormat('Y-m-d', $borrowingItems->tanggal_peminjaman)->format('d F Y') : old('tanggalPeminjaman') }}"
                                maxlength="255" />
                            @error('tanggalPeminjaman')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggalPengembalian">
                                Tanggal Pengembalian
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control date-picker" id="tanggalPengembalian" name="tanggalPengembalian"
                                required autocomplete="off" type="text" placeholder="Tanggal Pengembalian"
                                value="{{ $borrowingItems ? \Carbon\Carbon::createFromFormat('Y-m-d', $borrowingItems->tanggal_pengembalian)->format('d F Y') : old('tanggalPengembalian') }}"
                                maxlength="255" />
                            @error('tanggalPengembalian')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ruangan">
                                Ruangan
                                <span class="text-danger">*</span>
                            </label>
                            <select class="custom-select2 form-control" name="ruangan" id="ruangan" style="width: 100%;">
                                <option value="">Pilih Ruangan</option>
                                @if (!$rooms)
                                    <option>Ruangan belum tersedia...</option>
                                @else
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}"
                                            @if (old('ruangan') == $room->id) selected @endif
                                            @if ($distributionItem && $distributionItem->ruangan_id == $room->id) selected @endif>
                                            {{ $room->ruangan }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('ruangan')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pegawai">
                                Peminjam
                                <span class="text-danger">*</span>
                            </label>
                            <select class="custom-select2 form-control" name="pegawai" id="pegawai" style="width: 100%;">
                                <option value="">Pilih Peminjam</option>
                                @if (!$officers)
                                    <option>Peminjam belum tersedia...</option>
                                @else
                                    @foreach ($officers as $officer)
                                        <option value="{{ $officer->id }}"
                                            @if (old('pegawai') == $officer->id) selected @endif
                                            @if ($distributionItem && $distributionItem->pegawai_id == $officer->id) selected @endif>
                                            {{ $officer->nama }} ({{ $officer->jabatan }})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('pegawai')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 mx-auto">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="micon bi bi-save"></i> Save
                            </button>
                            <button type="reset" class="btn btn-sm btn-warning">
                                <i class="micon bi bi-recycle"></i> Reset
                            </button>
                            <a href="{{ route('dashboard.kondisi-barang') }}" class="btn btn-sm btn-secondary">
                                <i class="micon bi bi-reply"></i> Back
                            </a>
                        </div>

                    </form>
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
