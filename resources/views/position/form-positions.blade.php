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
                    <form action="{{ route('jabatan.save') }}" method="POST">
                        @method('POST')
                        @csrf
                        @if ($position && Crypt::decrypt($param) == 'update')
                            <div class="form-group" hidden>
                                <label for="id">
                                    ID
                                    <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" id="id" name="id" required autocomplete="off"
                                    type="text" placeholder="ID" value="{{ Crypt::encrypt($position->id) }}" readonly />
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
                            <label for="jabatan">
                                Jabatan
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="jabatan" name="jabatan" required autocomplete="off"
                                type="text" placeholder="Jabatan"
                                value="{{ $position ? $position->jabatan : old('jabatan') }}" />
                            @error('jabatan')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kodeJabatan">
                                Kode Jabatan
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="kodeJabatan" name="kodeJabatan" required autocomplete="off"
                                type="text" placeholder="Kode Jabatan"
                                value="{{ $position ? $position->kode_jabatan : old('kodeJabatan') }}" />
                            @error('kodeJabatan')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keterangan">
                                Keterangan
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="keterangan" id="keterangan" style="height: 100px;">{{ $position ? $position->keterangan : old('keterangan') }}</textarea>
                            @error('keterangan')
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
                            <a href="{{ route('dashboard.jabatan') }}" class="btn btn-sm btn-secondary">
                                <i class="micon bi bi-reply"></i> Back
                            </a>
                        </div>

                    </form>
                </div>
            </div>
            <div class="footer-wrap pd-20 mb-20 card-box">
                Copyright &copy; @SIMI
                <a href="https://github.com/dropways" style="text-decoration: none;" target="_blank">Qori Chairawan,
                    S.Kom</a>
            </div>
        </div>
    </div>
@endsection
