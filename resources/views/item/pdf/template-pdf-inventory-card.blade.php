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
        .table-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .table-item {
            margin-top: 10px;
            margin: 10px auto;
            width: 45%;
            border-collapse: collapse;
            border-spacing: 0 10px;
            font-size: 13px;
        }

        img {
            max-width: 50px;
        }
    </style>
</head>

<body>

    <div class="table-container">
        @for ($i = 1; $i <= $item->jumlah; $i++)
            <table class="table-item" cellpadding='5' border="1">
                <tr>
                    <td style="text-align: center;">
                        <img src="{{ public_path('storage/' . $institusi->logo) }}"
                            alt="Gambar {{ $institusi->nama_sekolah }}">
                    </td>
                    <td>
                        {{ $institusi->nama_sekolah }} <br>
                        Label Inventaris <br>
                        Kode Barang : {{ $item->kode_barang }}
                    </td>
                    <td>
                        QR CODE
                    </td>
                </tr>
            </table>
        @endfor
    </div>

</body>

</html>
