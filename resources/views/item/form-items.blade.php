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
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Perhatian</strong> Harap mengisi pendataan barang dengan teliti, pendataan yang ditelah
                        diajukan tidak dapat diubah kembali, kecuali persetujuan verifikator !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-blue" data-toggle="tab" href="#form" role="tab"
                                    aria-selected="true">Form Pendataan</a>
                            </li>
                            @if ($item)
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#kontrak" role="tab"
                                        aria-selected="false">Kontrak</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-blue" data-toggle="tab" href="#gambar" role="tab"
                                        aria-selected="false">Gambar</a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="form" role="tabpanel">
                                <form class="mt-2" action="{{ route('barang.save') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @method('POST')
                                    @csrf
                                    <div class="row">
                                        <!-- Col Left -->
                                        <div class="col-md-6">
                                            <div class="form-group" hidden>
                                                <label for="id">
                                                    ID
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="id" name="id" required
                                                    autocomplete="off" type="text" placeholder="ID"
                                                    value="{{ Str::uuid() }}" readonly />
                                            </div>
                                            @if ($item && Crypt::decrypt($param) == 'update')
                                                <div class="form-group" hidden>
                                                    <label for="id">
                                                        ID
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input class="form-control" id="id" name="id" required
                                                        autocomplete="off" type="text" placeholder="ID"
                                                        value="{{ Crypt::encrypt($item->id) }}" readonly />
                                                </div>
                                            @endif
                                            <div class="form-group" hidden>
                                                <label for="param">
                                                    Parameter
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="param" name="param" required
                                                    autocomplete="off" type="text" placeholder="Parameter"
                                                    value="{{ $param }}" readonly />
                                            </div>
                                            <div class="form-group">
                                                <label for="kodeBarang">
                                                    Kode Barang
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="kodeBarang" name="kodeBarang" required
                                                    autocomplete="off" type="text" placeholder="Kode Barang"
                                                    value="{{ $item ? $item->kode_barang : old('kodeBarang') }}"
                                                    maxlength="255" />
                                                @error('kodeBarang')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="namaBarang">
                                                    Nama Barang
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="namaBarang" name="namaBarang" required
                                                    autocomplete="off" type="text" placeholder="Nama Barang"
                                                    value="{{ $item ? $item->nama_barang : old('namaBarang') }}"
                                                    maxlength="255" />
                                                @error('namaBarang')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis">
                                                    Jenis
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="jenis" name="jenis" required
                                                    autocomplete="off" type="text" placeholder="Jenis"
                                                    value="{{ $item ? $item->jenis : old('jenis') }}" maxlength="255" />
                                                @error('jenis')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="merek">
                                                    Merek
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="merek" name="merek" required
                                                    autocomplete="off" type="text" placeholder="Merek"
                                                    value="{{ $item ? $item->merek : old('merek') }}" maxlength="255" />
                                                @error('merek')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tipe">
                                                    Tipe
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="tipe" name="tipe" required
                                                    autocomplete="off" type="text" placeholder="Tipe Barang"
                                                    value="{{ $item ? $item->tipe : old('tipe') }}" maxlength="255" />
                                                @error('tipe')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nomorSeri">
                                                    Nomor Seri
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="nomorSeri" name="nomorSeri" required
                                                    autocomplete="off" type="text" placeholder="Nomor Seri"
                                                    value="{{ $item ? $item->nomor_seri : old('nomorSeri') }}"
                                                    maxlength="255" />
                                                @error('nomorSeri')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="ukuran">
                                                    Ukuran
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="ukuran" name="ukuran" required
                                                    autocomplete="off" type="text" placeholder="Ukuran"
                                                    value="{{ $item ? $item->ukuran : old('ukuran') }}"
                                                    maxlength="255" />
                                                @error('ukuran')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="bahan">
                                                    Bahan
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="bahan" name="bahan" required
                                                    autocomplete="off" type="text" placeholder="Bahan"
                                                    value="{{ $item ? $item->bahan : old('bahan') }}" maxlength="255" />
                                                @error('bahan')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah">
                                                    Jumlah
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="jumlah" name="jumlah" required
                                                    autocomplete="off" type="number" placeholder="Jumlah"
                                                    value="{{ $item ? $item->jumlah : old('jumlah') }}" maxlength="255"
                                                    min="0" />
                                                @error('jumlah')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="satuan">
                                                    Satuan
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select class="custom-select2 form-control" name="satuan" id="satuan"
                                                    style="width: 100%;">
                                                    <option value="">Pilih Satuan</option>
                                                    @if (!$unitItem)
                                                        <option>Satuan barang belum tersedia...</option>
                                                    @else
                                                        @foreach ($unitItem->get() as $unit)
                                                            <option value="{{ $unit->id }}"
                                                                @if (old('satuan') == $unit->id) selected @endif
                                                                @if ($item && $item->satuan_barang_id == $unit->id) selected @endif>
                                                                {{ $unit->satuan }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('satuan')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Col Right -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="harga">
                                                    Harga
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="harga" name="harga" required
                                                    autocomplete="off" type="number" placeholder="Harga"
                                                    value="{{ $item ? $item->harga : old('harga') }}" maxlength="255"
                                                    min="0" />
                                                @error('harga')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="sumberDana">
                                                    Sumber Dana
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="sumberDana" name="sumberDana" required
                                                    autocomplete="off" type="text" placeholder="Sumber Dana"
                                                    value="{{ $item ? $item->nomor_seri : old('sumberDana') }}"
                                                    maxlength="255" />
                                                @error('sumberDana')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kondisi">
                                                    Kondisi
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select class="custom-select2 form-control" name="kondisi" id="kondisi"
                                                    style="width: 100%;" required>
                                                    <option value="">Pilih Kondisi</option>
                                                    @if (!$conditionItem)
                                                        <option>Kondisi barang belum tersedia...</option>
                                                    @else
                                                        @foreach ($conditionItem->get() as $condition)
                                                            <option value="{{ $condition->id }}"
                                                                @if (old('kondisi') == $condition->id) selected @endif
                                                                @if ($item && $item->kondisi_barang_id == $condition->id) selected @endif>
                                                                {{ $condition->kondisi }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('kondisi')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tahun">
                                                    Tahun Pengadaan
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select class="custom-select2 form-control" name="tahun" id="tahun"
                                                    style="width: 100%;" required>
                                                    <option value="">Pilih Tahuan Pengadaan</option>
                                                    @php
                                                        $years = [2024, 2025, 2026, 2027, 2028, 2029];
                                                    @endphp
                                                    @foreach ($years as $year)
                                                        <option value="{{ $year }}"
                                                            @if (old('tahun') == $year) selected @endif
                                                            @if ($item && $item->tahun_pengadaan == $year) selected @endif>
                                                            {{ $year }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('tahun')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nomorKontrak">
                                                    Nomor Kontrak/Kwitansi/Faktur
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control" id="nomorKontrak" name="nomorKontrak"
                                                    required autocomplete="off" type="text"
                                                    placeholder="Nomor Kontrak/Kwitansi/Faktur"
                                                    value="{{ $item ? $item->nomor_kontrak : old('nomorKontrak') }}"
                                                    maxlength="255" />
                                                @error('nomorKontrak')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggalKontrak">
                                                    Tanggal Kontrak/Kwintasi/Faktur
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input class="form-control date-picker" id="tanggalKontrak"
                                                    name="tanggalKontrak" required autocomplete="off" type="text"
                                                    placeholder="Tanggal Kontrak/Kwintasi/Faktur"
                                                    value="{{ $item ? \Carbon\Carbon::createFromFormat('Y-m-d', $item->tanggal_kontrak)->format('d F Y') : old('tanggalKontrak') }}"
                                                    maxlength="255" />
                                                @error('tanggalKontrak')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="edoc">
                                                    Unggah File
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="file" name="edoc"
                                                    class="form-control-file form-control height-auto" />
                                                <small>* Maksimal file berukuran 5MB dan bertipe PDF</small>
                                                @if ($item)
                                                    <br>
                                                    <small>* Kosongkan file jika tidak ingin mengganti !</small>
                                                @endif
                                                @error('edoc')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="image">
                                                    Unggah Gambar
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="file" name="image"
                                                    class="form-control-file form-control height-auto" />
                                                <small>* Maksimal file berukuran 5MB dan bertipe png/jpg/jpeg</small>
                                                @if ($item)
                                                    <br>
                                                    <small>* Kosongkan file jika tidak ingin mengganti !</small>
                                                @endif
                                                @error('image')
                                                    <small class="text-danger">* {{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">
                                            Keterangan
                                        </label>
                                        <textarea class="form-control" name="keterangan" id="keterangan" style="height: 100px;">{{ $item ? $item->keterangan : old('keterangan') }}</textarea>
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
                                        <a href="{{ route('dashboard.barang') }}" class="btn btn-sm btn-secondary">
                                            <i class="micon bi bi-reply"></i> Back
                                        </a>
                                    </div>

                                </form>
                            </div>
                            @if ($item)
                                <div class="tab-pane fade" id="kontrak" role="tabpanel">
                                    <embed style="width: 100%; height:100vh;"
                                        src="{{ asset('storage/' . $item->file_edoc) }}" type="">
                                </div>
                                <div class="tab-pane fade" id="gambar" role="tabpanel">
                                    <img class="img img-fluid pt-20" src="{{ asset('storage/' . $item->file_image) }}"
                                        alt="Gambar {{ $item->nama_barang }}">
                                </div>
                            @endif
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
@endsection
