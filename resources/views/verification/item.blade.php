<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Info -->
        <meta charset="utf-8" />
        <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

      <!-- Site favicon -->
    <link rel="apple-touch-icon" href="{{ asset('resources/images/SIMI Logo - Favicon - 32x32.png') }} " />
    <link rel="icon" type="image/png" href="{{ asset('resources/images/SIMI Logo - Favicon - 32x32.png') }}" />


        <!-- Mobile Specific Metas -->
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, maximum-scale=1"
        />

        <!-- Google Font -->
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet"
        />
        <!-- CSS -->
      <!-- CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('resources/vendors/styles/core.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ asset('resources/vendors/styles/icon-font.min.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ asset('resources/vendors/styles/style.css') }}" />

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script
            async
            src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"
        ></script>
        <script
            async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258"
            crossorigin="anonymous"
        ></script>
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
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    "gtm.start": new Date().getTime(),
                    event: "gtm.js",
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
    <body class="login-page">
        <div class="login-header box-shadow">
            <div
                class="container-fluid d-flex justify-content-between align-items-center"
            >
                <div class="brand-logo">
                    <a href="login.html">
                        <img src="vendors/images/deskapp-logo.svg" alt="" />
                    </a>
                </div>
                <div class="login-menu">
                    <ul>
                    </ul>
                </div>
            </div>
        </div>
        <div
            class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
        >
            <div class="container">
                <div class="row align-items-center">

                </div>
            </div>
        </div>

        <!-- welcome modal end -->
        <script src="{{ asset('resources/vendors/scripts/core.js') }}"></script>
        <script src="{{ asset('resources/vendors/scripts/script.min.js') }}"></script>
        <script src="{{ asset('resources/vendors/scripts/process.js') }}"></script>
        <script src="{{ asset('resources/vendors/scripts/layout-settings.js') }}"></script>
        <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    </body>

</html>
