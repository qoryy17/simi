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
            <td>
                <h2>Daftar Inventaris Ruangan</h2>
                <p>{{ env('APP_NAME') }} {{ env('APP_NAME_DESCRIPTION_ID') }}</p>
            </td>
        </tr>
        <tr>
            <td>
             Nomor BAST
            </td>
            <td>
                {{ $distribution->nomor_bast }}
            </td>
        </tr>
        <tr>
            <td>
             Ruangan
            </td>
            <td>
                {{ $distribution->rooms[0]->ruangan }}
            </td>
        </tr>
        <tr>
            <td>
                <h3>Daftar Barang</h3>
            </td>
        </tr>
    </table>
    <table class="table-item" cellpadding='5' border="1">
        <tr>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Merek</th>
            <th>Jumlah</th>
        </tr>
        @forelse($distribution->listDistributionItems as $item)
        <tr>
            <td>{{$item->items->kode_barang}}</td>
            <td>{{$item->items->nama_barang}}</td>
            <td>{{$item->items->merek}}</td>
            <td>{{$item->items->jumlah}}</td>
        </tr>
        @empty

        @endforelse
    </table>

    <table class="table-title" cellpadding="5">
        <tr>
            <td>
                <h5>Penerima</h5>
            </td>
            <td>
                <h5>Verifikator</h5>
            </td>
        </tr>
        <tr>
            <td style="line-height: 0;">
                <h5><u>{{$penerima->nama}}</u></h5>
                <h5 style="transform: translateY(-4px)">{{$penerima->nip}}</h5>
            </td>
            <td style="line-height: 0;">
                <h5><u>{{$verifikator->name}}</u></h5>
                <h5 style="transform: translateY(-4px)">{{$verifikator->email}}</h5>
            </td>
        </tr>
    </table>

    <p style="font-size: 11px; margin-top: 30px;">
        Generate Timestamp : {{ now() }} <br> Generate By : {{ Auth::user()->name }}
    </p>
</body>

</html>
