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
                    <form action="{{ route('pengguna.save') }}" action="" method="POST">
                        @method('POST')
                        @csrf
                        @if ($user && Crypt::decrypt($param) == 'update')
                            <div class="form-group" hidden>
                                <label for="id">ID <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" id="id" name="id" required autocomplete="off"
                                    type="text" placeholder="ID" value="{{ Crypt::encrypt($user->id) }}" readonly />
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
                            <label for="pegawai">
                                Pegawai
                                <span class="text-danger">*</span>
                            </label>
                            <select class="custom-select2 form-control" name="pegawai" id="pegawai" style="width: 100%;">
                                <option value="">Pilih Pegawai</option>
                                @if (!$officers)
                                    <option>Guru / Pegawai belum tersedia...</option>
                                @else
                                    @foreach ($officers->get() as $item)
                                        <option @if ($user && $user->pegawai_id == $item->id) selected @endif
                                            @if (old('pegawai') == $item->id) selected @endif value="{{ $item->id }}">
                                            {{ $item->nama }} ({{ $item->jabatan }})
                                        </option>
                                    @endforeach
                                @endif
                                @error('pegawai')
                                    <small class="text-danger">* {{ $message }}</small>
                                @enderror
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email
                                <span class="text-danger">*</span>
                            </label>
                            <input class="form-control" id="email" name="email" required autocomplete="off"
                                type="text" placeholder="Email" value="{{ $user ? $user->email : old('email') }}" />
                            @error('email')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            @if ($user && Crypt::decrypt($param) == 'update')
                                <label for="password">
                                    Password Baru
                                </label>
                                <input class="form-control" id="password" name="password" autocomplete="off"
                                    type="password" placeholder="Password" value="{{ old('password') }}" />
                                <small class="text-danger">Kosongkan jika tidak ingin mengganti</small>
                                @error('password')
                                    <small class="text-danger">* {{ $message }}</small>
                                @enderror
                            @else
                                <label for="password">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <input class="form-control" id="password" name="password" required autocomplete="off"
                                    type="password" placeholder="Password" value="{{ old('password') }}" />
                                @error('password')
                                    <small class="text-danger">* {{ $message }}</small>
                                @enderror
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="role">
                                Role
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" name="role" id="role">
                                <option value="">Pilih Role</option>
                                <option value="Superadmin" @if (old('role') == 'Superadmin') selected @endif
                                    @if ($user && $user->role == 'Superadmin') selected @endif>Superadmin
                                </option>
                                <option value="Operator" @if (old('role') == 'Operator') selected @endif
                                    @if ($user && $user->role == 'Operator') selected @endif>Operator
                                </option>
                                <option value="Verifikator" @if (old('role') == 'Verifikator') selected @endif
                                    @if ($user && $user->role == 'Verifikator') selected @endif>Verifikator
                                </option>
                            </select>
                            @error('role')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="blokir">
                                Blokir
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" name="blokir" id="blokir">
                                <option value="">Pilih Status Blokir</option>
                                <option value="Y" @if (old('blokir') == 'Y') selected @endif
                                    @if ($user && $user->blokir == 'Y') selected @endif>Y (Ya)
                                </option>
                                <option value="T" @if (old('blokir') == 'T') selected @endif
                                    @if ($user && $user->blokir == 'T') selected @endif>T (Tidak)
                                </option>
                            </select>
                            @error('blokir')
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
                            <a href="{{ route('dashboard.pengguna') }}" class="btn btn-sm btn-secondary">
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
