<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler-flags.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler-payments.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/css/tabler-vendors.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark-dimmed.min.css">
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .hljs {
            background: unset;
        }
    </style>

    <style>
        .card-title .card-subtitle {
            margin-left: 0;
        }

        .card-subtitle {
            margin-bottom: .5rem;
        }
    </style>

    @stack('styles')
    @livewireStyles
</head>
<body>
<script>
    /*!
    * Tabler v1.0.0-beta20 (https://tabler.io)
    * @version 1.0.0-beta20
    * @link https://tabler.io
    * Copyright 2018-2023 The Tabler Authors
    * Copyright 2018-2023 codecalm.net Paweł Kuna
    * Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
    */
    !function (e) {
        "function" == typeof define && define.amd ? define(e) : e()
    }((function () {
        "use strict";
        var e, t = "tablerTheme", a = new Proxy(new URLSearchParams(window.location.search), {
            get: function (e, t) {
                return e.get(t)
            }
        });
        if (a.theme) localStorage.setItem(t, a.theme), e = a.theme; else {
            var n = localStorage.getItem(t);
            e = n || "light"
        }
        "dark" === e ? document.body.setAttribute("data-bs-theme", e) : document.body.removeAttribute("data-bs-theme")
    }));
</script>
<div class="page">
    <header class="navbar navbar-expand-md d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href=".">
                    <img src="https://preview.tabler.io/static/logo.svg" width="110" height="32" alt="Tabler"
                         class="navbar-brand-image">
                </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="d-none d-md-flex">
                    <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" data-bs-toggle="tooltip"
                       data-bs-placement="bottom" aria-label="Enable dark mode"
                       data-bs-original-title="Enable dark mode">
                        <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path>
                        </svg>
                    </a>
                    <a href="?theme=light" class="nav-link px-0 hide-theme-light" data-bs-toggle="tooltip"
                       data-bs-placement="bottom" aria-label="Enable light mode"
                       data-bs-original-title="Enable light mode">
                        <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                            <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <!-- Navbar -->
    <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">
                <div class="container-xl">
                    <div class="row flex-fill align-items-center">
                        <div class="col">
                            <ul class="navbar-nav">
                                <li @class(['nav-item', 'active' => (request()->url() === route('admix-ui.docs'))])>
                                    <a class="nav-link" href="{{ route('admix-ui.docs') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Instalação
                                        </span>
                                    </a>
                                </li>
                                <li @class(['nav-item', 'active' => (request()->url() === route('admix-ui.docs', ['file' => 'pages']))])>
                                    <a class="nav-link" href="{{ route('admix-ui.docs', ['file' => 'pages']) }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-layout-sidebar" width="24"
                                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"/>
                                                <path d="M9 4l0 16"/>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Páginas
                                        </span>
                                    </a>
                                </li>
                                <li @class(['nav-item', 'active' => (request()->url() === route('admix-ui.docs', ['file' => 'form']))])>
                                    <a class="nav-link" href="{{ route('admix-ui.docs', ['file' => 'form']) }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-forms" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M12 3a3 3 0 0 0 -3 3v12a3 3 0 0 0 3 3"/>
                                                <path d="M6 3a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3"/>
                                                <path d="M13 7h7a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-7"/>
                                                <path d="M5 7h-1a1 1 0 0 0 -1 1v8a1 1 0 0 0 1 1h1"/>
                                                <path d="M17 12h.01"/>
                                                <path d="M13 12h.01"/>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Formulário
                                        </span>
                                    </a>
                                </li>
                                <li @class(['nav-item', 'active' => (request()->url() === route('admix-ui.docs', ['file' => 'ui']))])>
                                    <a class="nav-link" href="{{ route('admix-ui.docs', ['file' => 'ui']) }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-brand-tabler" width="24"
                                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M8 9l3 3l-3 3"/>
                                                <path d="M13 15l3 0"/>
                                                <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"/>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            UI
                                        </span>
                                    </a>
                                </li>
                                <li @class(['nav-item', 'active' => (request()->url() === route('admix-ui.docs', ['file' => 'modal']))])>
                                    <a class="nav-link" href="{{ route('admix-ui.docs', ['file' => 'modal']) }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-app-window" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"/>
                                                <path d="M6 8h.01"/>
                                                <path d="M9 8h.01"/>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Modal
                                        </span>
                                    </a>
                                </li>
                                <li @class(['nav-item', 'active' => (request()->url() === route('admix-ui.docs', ['file' => 'thirty-parts']))])>
                                    <a class="nav-link" href="{{ route('admix-ui.docs', ['file' => 'thirty-parts']) }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="icon icon-tabler icon-tabler-external-link" width="24"
                                                 height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6"/>
                                                <path d="M11 13l9 -9"/>
                                                <path d="M15 4h5v5"/>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            Terceiros
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-2 d-none d-xxl-block">
                            <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                                <form action="./" method="get" autocomplete="off" novalidate="">
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                <path d="M21 21l-6 -6"></path>
                                            </svg>
                                        </span>
                                        <input type="text" value="" class="form-control" placeholder="Search…"
                                               aria-label="Search in website">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="page-wrapper">
        <!-- Page header -->
        {{--        <div class="page-header d-print-none">--}}
        {{--            <div class="container-xl">--}}
        {{--                <div class="row g-2 align-items-center">--}}
        {{--                    <div class="col">--}}
        {{--                        <h2 class="page-title">--}}
        {{--                            {{ $title ?? 'Instalação' }}--}}
        {{--                        </h2>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row justify-content-center">
                    <div class="-col-12 -col-lg-10 -col-xl-9">
                        <div class="card card-lg">
                            <div class="card-body markdown">
                                {!! $markdown ?? '' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ms-lg-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item"><a href="https://tabler.io/docs" target="_blank"
                                                            class="link-secondary" rel="noopener">Documentation</a></li>
                            <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a>
                            </li>
                            <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank"
                                                            class="link-secondary" rel="noopener">Source code</a></li>
                            <li class="list-inline-item">
                                <a href="https://github.com/sponsors/codecalm" target="_blank" class="link-secondary"
                                   rel="noopener">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="icon text-pink icon-filled icon-inline" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path>
                                    </svg>
                                    Sponsor
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright © 2023
                                <a href="." class="link-secondary">Tabler</a>.
                                All rights reserved.
                            </li>
                            <li class="list-inline-item">
                                <a href="./changelog.html" class="link-secondary" rel="noopener">
                                    v1.0.0-beta20
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta20/dist/js/tabler.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://unpkg.com/highlightjs-blade/dist/blade.min.js"></script>
<script>hljs.highlightAll();</script>

@stack('scripts')
@livewireScripts
</body>
</html>