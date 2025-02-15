@extends('layout.body')
@section('title', $title)
@section('content')
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>{{ $bc2 }}</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard.home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
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
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    {{-- <a href="{{ route('barang.form', ['param' => 'add', 'id' => Crypt::encrypt('null')]) }}"
                        class="btn btn-sm btn-primary"><i class="micon bi bi-person-plus"></i> Tambah List Data Barang
                    </a> --}}
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-delete" data-toggle="modal"
                        type="button" data-target="#add-modal" onclick="addItemDelete(this)">
                        <i class="icon-add bi bi-plus"></i> Tambah list barang
                    </a>
                </div>
                <div class="pl-10 d-flex">
                    <div class="d-flex align-items-center  justify-content-center">
                        <h6>Kode Distribusi : </h6>
                        <p class="btn btn-sm btn-secondary mb-0 ml-2 mr-2">{{ $distributionItem->kode_distribusi }}</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <h6>Ruangan : </h6>
                        <p class="btn btn-sm btn-secondary mb-0 ml-2 mr-2">{{ $distributionItem->rooms[0]->ruangan }}</p>
                    </div>

                </div>
                <div class="pb-20 pt-30">
                    <table class="data-table table hover nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="table-plus datatable-nosort">Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Nomor Seri</th>
                                <th>Catatan</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($distributionItem->listDistributionItems as $item)
                                <tr>
                                    <td>1</td>
                                    <td class="table-plus">{{ $item->kode_barang }}</td>
                                    <td>{{ $item->items->nama_barang }}</td>
                                    <td>{{ $item->items->nomor_seri }}</td>
                                    <td>{{ $item->catatan }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a class="btn-delete" href="#" data-toggle="modal" type="button"
                                            data-target="#confirmation-modal" data-id="{{ Crypt::encrypt($item->id) }}"
                                            onclick="addItemDelete(this)">
                                            <i class="dw dw-delete-3"></i>
                                            Delete
                                        </a>
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
                            <form action="{{ route('listDistribusiBarang.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" required readonly placeholder="ID...."
                                        value="" name="id" id="itemID">
                                </div>
                                <div class="form-group" hidden>
                                    <input type="text" class="form-control" required readonly placeholder="ID...."
                                        value="{{ Crypt::encrypt($distributionItem->id) }}" name="distribution_id"
                                        id="distributionItemID">
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
                Copyright &copy; {{ date('Y') }}
                <a href="" style="text-decoration: none;" target="_blank">
                    {{ env('APP_NAME') }} - {{ env('APP_NAME_DESCRIPTION') }}
                </a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body font-18">
                    <h4 class="padding-top-30 text-center">
                        Tambah Data Barang
                    </h4>
                    <form action="{{ route('listDistribusiBarang.save') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group" hidden>
                            <input type="text" class="form-control" required readonly placeholder="ID...."
                                value="{{ Crypt::encrypt($distributionItem->id) }}" name="id" id="itemID">
                        </div>
                        <div class="form-group">
                            <label for="barang">
                                Barang
                                <span class="text-danger">*</span>
                            </label>
                            <select class="custom-select2 form-control" name="barang" id="barang"
                                style="width: 100%;">
                                @if ($items->isEmpty())
                                    <option disabled>Barang belum tersedia...</option>
                                @else
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}"
                                            @if (old('barang') == $item->id) selected @endif>
                                            {{ $item->nama_barang }} - {{ $item->nomor_seri }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('barang')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control" autocomplete="off" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Simpan <i class="fa fa-check"></i>
                            </button>
                        </div>
                    </form>
                </div>
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
@endsection)
