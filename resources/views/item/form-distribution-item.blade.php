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
                    <form action="{{ route('distribusiBarang.save') }}" method="POST">
                        @method('POST')
                        @csrf
                        @if ($distributionItem && Crypt::decrypt($param) == 'update')
                            <div class="form-group" hidden>
                                <label for="id">
                                    ID
                                    <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" id="id" name="id" required autocomplete="off"
                                    type="text" placeholder="ID" value="{{ Crypt::encrypt($distributionItem->id) }}"
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
                            <label for="nomorBast">
                                Nomor Bast
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="nomorBast" name="nomorBast" required autocomplete="off"
                                type="text" placeholder="Nomor Bast"
                                value="{{ $distributionItem ? $distributionItem->nomor_bast : old('nomorBast') }}" />
                            @error('nomorBast')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ruangan">
                                Ruangan
                                <span class="text-danger">*</span>
                            </label>
                            <select class="custom-select2 form-control" name="ruangan" id="ruangan"
                                style="width: 100%;">
                                <option value="">Pilih Ruangan</option>
                                @if (!$rooms)
                                    <option>Ruangan belum tersedia...</option>
                                @else
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}"
                                            @if (old('ruangan') == $room->id) selected @endif
                                            @if ($room && $room->ruangan_id == $room->id) selected @endif>
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
                            <label for="listDistributionItem">
                                List Distribusi Barang
                                <span class="text-danger">*</span>
                            </label>
                            <select class="custom-select2 form-control" name="listDistributionItem" id="listDistributionItem"
                                style="width: 100%;">
                                <option value="" >Pilih List Distribusi Barang</option>
                                @if (!$listDistributionItems)
                                    <option>List Distribusi Barang belum tersedia...</option>
                                @else
                                    @foreach ($listDistributionItems as $item)
                                        <option value="{{ $item->id }}"
                                            @if (old('listDistributionItem') == $item->id) selected @endif
                                            @if ($item && $item->barang_id == $item->id) selected @endif>
                                            {{ $item->kode_distribusi }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('listDistributionItem')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">
                                Keterangan
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="keterangan" id="keterangan" style="height: 100px;">{{ $distributionItem ? $distributionItem->keterangan : old('keterangan') }}</textarea>
                            @error('keterangan')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">
                                Status
                                <span class="text-danger">*</span>
                            </label>
                            <select class="custom-select2 form-control" name="status" id="status"
                                style="width: 100%;">
                                <option value="" >Pilih Status</option>
                                <option value="Pratinjau">Pratinjau</option>
                                <option value="Pengajuan">Pengajuan</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                            @error('status')
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
