<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Site favicon -->
    <link rel="apple-touch-icon" href="{{ asset('resources/images/SIMI Logo - Favicon - 32x32.png') }} " />
    <link rel="icon" type="image/png" href="{{ asset('resources/images/SIMI Logo - Favicon - 32x32.png') }}" />

    <title>{{ $pageTitle }}</title>
    <style type="text/css">
        .header {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .header img {
            max-width: 80px;
        }

        .header h3,
        p {
            margin: 0 auto;
        }

        .table-title {
            width: 100%;
            border-collapse: collapse;
        }

        .table-title h2,
        p {
            margin: 0 auto;
        }

        .table-item {
            margin-top: 20px;
            table-layout: auto;
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        img {
            max-width: 300px;
        }
    </style>
</head>

<body>
    <table class="header">
        <tr>
            <td style="text-align: center;" width="10%">
                <img src="{{ public_path('storage/' . $institusi->logo) }}" alt="Gambar {{ $institusi->nama_sekolah }}">
            </td>
            <td style="text-align: center;">
                <h3 style="text-transform: uppercase;">
                    Dinas Pendidikan {{ $institusi->cabdis_provinsi }} <br>Cabang
                    Dinas Pendidikan {{ $institusi->cabdis_kabupaten }}
                </h3>
                <h3>{{ $institusi->nama_sekolah }}</h3>
                <p>{{ $institusi->alamat }}</p>
                <p style="font-size: 12px;">NPSN: {{ $institusi->npsn }} Website : {{ $institusi->website }} Email :
                    {{ $institusi->email }} Telepon
                    : {{ $institusi->telepon }}
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="border-bottom: 1pt solid black"></td>
        </tr>
    </table>
    <table class="table-title" cellpadding="5">
        <tr>
            <td width="90%">
                <h2>Informasi Pendataan Barang</h2>
                <p>{{ env('APP_NAME') }} {{ env('APP_NAME_DESCRIPTION_ID') }}</p>
            </td>
            <td width="10%">
                <img src="{{ public_path('storage/' . $item->file_image) }}" alt="Gambar {{ $item->nama_barang }}">
            </td>
        </tr>
    </table>
    <table class="table-item" cellpadding='5' border="1">
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
                        $color = 'orange';
                    @endphp
                @elseif ($item->status == 'Pengajuan')
                    @php
                        $color = 'black';
                    @endphp
                @elseif ($item->status == 'Selesai')
                    @php
                        $color = 'green';
                    @endphp
                @endif
                <span style="color: {{ $color }};">
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
                            $bgcolor = 'green';
                        @endphp
                    @elseif($verification->status == 'Ditolak')
                        @php
                            $bgcolor = 'red';
                        @endphp
                    @endif

                    <p>{{ $verification->keterangan }}</p>
                    <span style="color: {{ $bgcolor }};">Verifikasi :
                        {{ $verification->status }}</span>
                    | Verifikator : {{ $verifikator->name }} | Timestamp :
                    {{ $verification->updated_at }}
                @endif
            </td>
        </tr>
    </table>

    <p style="font-size: 11px; margin-top: 30px;">
        Generate Timestamp : {{ now() }} <br> Generate By : {{ Auth::user()->name }}
    </p>
</body>

</html>
