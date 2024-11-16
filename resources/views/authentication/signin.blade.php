<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" href="{{ asset('resources/images/SIMI Logo - Favicon - 32x32.png') }} " />
    <link rel="icon" type="image/png" href="{{ asset('resources/images/SIMI Logo - Favicon - 32x32.png') }}" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Sweet Alert -->
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/src/plugins/sweetalert2/sweetalert2.css') }}" />

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/vendors/styles/style.css') }}" />

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

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="#">
                    <img src="{{ asset('resources/images/SIMI Logo - Original with Transparent Background.svg') }}"
                        alt="Simi Logo" />
                </a>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img style="width: 80%; object-fit: contain"
                        src="{{ asset('resources/images/thumbnail/thumbnail-image-login.png') }}" alt="Simi Logo" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Signin To SIMI</h2>
                            <p class="text-center m-0 p-0">{{ env('APP_NAME_DESCRIPTION_ID') }}</p>
                        </div>
                        <form action="{{ route('auth.login') }}" method="POST">
                            @method('POST')
                            @csrf
                            @error('email')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                            <div class="input-group custom">
                                <input type="email" required autocomplete="off" name="email"
                                    class="form-control form-control-lg" placeholder="example@local.com"
                                    value="{{ old('email') }}" required />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            @error('password')
                                <small class="text-danger">* {{ $message }}</small>
                            @enderror
                            <div class="input-group custom">
                                <input type="password" required autocomplete="off" name="password"
                                    class="form-control form-control-lg" placeholder="**********"
                                    value="{{ old('password') }}" required />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-1">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Masuk</button>
                            </div>
                            <small class="text-center">Lupa Sandi ? Hubungi Superadmin</small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="{{ asset('resources/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('resources/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('resources/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('resources/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('resources/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    @if (session()->has('error'))
        <script>
            swal({
                type: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}"
            });
        </script>
    @endif
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>
