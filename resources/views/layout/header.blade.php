<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" href="{{ asset('resources/images/SIMI Logo - Favicon - 32x32.png') }} " />
    <link rel="icon" type="image/png" href="{{ asset('resources/images/SIMI Logo - Favicon - 32x32.png') }}" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Datatables -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('resources/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('resources/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />

    <!-- Sweet Alert -->
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/src/plugins/sweetalert2/sweetalert2.css') }}" />

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/vendors/styles/style.css') }}" />

    <script src="{{ asset('resources/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
        crossorigin="anonymous"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <!-- End Google Tag Manager -->

</head>

<body>
