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
                    <form action="{{ route('guruPegawai.save') }}" action="" method="POST">
                        @method('POST')
                        @csrf
                        @if ($officer && Crypt::decrypt($param) == 'update')
                            <div class="form-group" hidden>
                                <label for="id">ID <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" id="id" name="id" required autocomplete="off"
                                    type="text" placeholder="ID" value="{{ Crypt::encrypt($officer->id) }}" readonly />
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
                            <label for="nip">
                                NIP
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="nip" name="nip" required autocomplete="off"
                                type="text" placeholder="NIP" value="{{ $officer ? $officer->nip : old('nip') }}" />
                            @error('nip')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namaLengkap">
                                Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="namaLengkap" name="namaLengkap" required autocomplete="off"
                                type="text" placeholder="Nama Lengkap"
                                value="{{ $officer ? $officer->nama : old('namaLengkap') }}" />
                            @error('namaLengkap')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jabatan">
                                Jabatan
                                <span class="text-danger">*</span>
                            </label>
                            <select class="custom-select2 form-control" name="jabatan" id="jabatan" required
                                style="width: 100%;">
                                <option value="">Pilih Jabatan</option>
                                @if (!$position)
                                    <option>Jabatan belum tersedia...</option>
                                @else
                                    @foreach ($position->get() as $item)
                                        <option value="{{ $item->id }}"
                                            @if ($officer && $officer->jabatan_id == $item->id) selected @endif
                                            @if (old('jabatan') == $item->id) selected @endif>
                                            {{ $item->jabatan }} -- Kode : {{ $item->kode_jabatan }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('jabatan')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">
                                Status
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" name="status" id="status">
                                <option value="">Pilih Status</option>
                                <option value="Aktif" @if ($officer && $officer->status == 'Aktif') selected @endif
                                    @if (old('status') == 'Aktif') selected @endif>
                                    Aktif
                                </option>
                                <option value="Non Aktif" @if ($officer && $officer->status == 'Non Aktif') selected @endif
                                    @if (old('status') == 'Non Aktif') selected @endif>Non Aktif</option>
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
                            <a href="{{ route('dashboard.ruangan') }}" class="btn btn-sm btn-secondary">
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
