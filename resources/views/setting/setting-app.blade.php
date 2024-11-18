@extends('layout.body')
@section('title', $title)
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="card card-box mb-30">
                <div class="card-body">
                    <h5 class="card-title mb-20">Pengaturan Aplikasi </h5>
                    <form action="{{ route('pengaturan.save') }}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group" hidden>
                            <label for="id">
                                ID
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="id" name="id" autocomplete="off" type="text"
                                placeholder="ID" value="{{ $setting ? Crypt::encrypt($setting->id) : old('id') }}"
                                readonly />
                            @error('id')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cabdisProvinsi">
                                Cabdis Pendidikan Provinsi
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="cabdisProvinsi" name="cabdisProvinsi" required
                                autocomplete="off" type="text" placeholder="Cabang Dinas Pendidikan Provinsi"
                                value="{{ $setting ? $setting->cabdis_provinsi : old('cabdisProvinsi') }}" />
                            @error('cabdisProvinsi')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cabdisKabupaten">
                                Cabdis Pendidikan Kota/Kabupaten
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="cabdisKabupaten" name="cabdisKabupaten" required
                                autocomplete="off" type="text" placeholder="Cabang Dinas Pendidikan Kota/Kabupaten"
                                value="{{ $setting ? $setting->cabdis_kabupaten : old('cabdisKabupaten') }}" />
                            @error('cabdisKabupaten')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="npsn">
                                NPSN Sekolah
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="npsn" name="npsn" required autocomplete="off"
                                type="text" placeholder="NPSN Sekolah"
                                value="{{ $setting ? $setting->npsn : old('npsn') }}" />
                            @error('npsn')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="namaSekolah">
                                Nama Sekolah
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="namaSekolah" name="namaSekolah" required autocomplete="off"
                                type="text" placeholder="Nama Sekolah"
                                value="{{ $setting ? $setting->nama_sekolah : old('namaSekolah') }}" />
                            @error('namaSekolah')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">
                                Alamat
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" name="alamat" id="alamat" required autocomplete="off" placeholder="Alamat"
                                rows="1" style="height: 80px;">{{ $setting ? $setting->alamat : old('alamat') }}</textarea>
                            @error('alamat')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email Sekolah
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="email" name="email" required autocomplete="off"
                                type="text" placeholder="Email Sekolah"
                                value="{{ $setting ? $setting->email : old('email') }}" />
                            @error('email')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="telepon">
                                Telepon
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="telepon" name="telepon" required autocomplete="off"
                                type="text" placeholder="Telepon"
                                value="{{ $setting ? $setting->telepon : old('telepon') }}" />
                            @error('telepon')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="website">
                                Website
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="website" name="website" required autocomplete="off"
                                type="text" placeholder="Website"
                                value="{{ $setting ? $setting->website : old('website') }}" />
                            @error('website')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="logo">
                                Logo
                                <span class="text-danger">*</span>
                            </label>
                            <input type="file" id="logo" name="logo"
                                class="form-control-file form-control height-auto">
                            @error('logo')
                                <small class="text-danger">* {{ $message }}</small> <br>
                            @enderror
                            <small style="font-style: italic;" class="text-danger">
                                NB : Kosongkan jika tidak ingin mengganti logo
                            </small>
                        </div>
                        @if ($setting)
                            <img class="d-block mb-3 mt-2 img img-thumbnail" width="200px"
                                src="{{ asset('storage/images/config/' . $setting->logo) }}" alt="logo">
                        @endif
                        <button type="submit" class="btn btn-sm btn-primary d-block d-md-inline-block">
                            <i class="micon bi bi-save"></i> Save
                        </button>
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
