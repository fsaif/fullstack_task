<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Styles -->
    @if (app()->getLocale() == 'en')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/app_rtl.css') }}" rel="stylesheet">
    @endif
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- custom style -->
    <link href="{{ asset('css/uikit.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" media="only screen and (max-width: 1200px)"/>

    <!-- ==== FONTS ==== -->
    @if(app()->getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
        <!-- Arabic Font Style -->
        <style>
            body {
                font-family: 'Tajawal', sans-serif;
            }
        </style>
    @endif

</head>
<body>
<div id="app">
    <div class="container">
        @guest
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    @foreach (config('translatable.locales') as $lang => $language)
                        @if($lang != app()->getLocale())
                            <a href="{{ route('lang.switch', $lang) }}" class="nav-link">
                                {{ $language }}
                            </a>
                        @endif
                    @endforeach
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        {{$dd}}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($currencies as $currency)
                            <li>
                                <a href="{{ route('changeCurrency', $currency->currencyID) }}" class="nav-link">
                                    {{ $currency->shortcut }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <!-- Authentication Links -->
                <li class="nav-item">
                    <a class="nav-link px-0" href="{{ route('signin') }}">@lang('app.link_a')</a>
                </li>
                <li class="nav-item disabled">
                    <a class="nav-link px-0">|</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-0" href="{{ route('signup') }}">@lang('app.link_b')</a>
                </li>

            </ul>

        @else
            <ul class="nav justify-content-start">

                @foreach(config('translatable.locales') as $lang => $language)
                    @if($lang != app()->getLocale())
                        <li class="nav-item">
                            <a href="{{ route('lang.switch', $lang) }}" class="nav-link">
                                {{ $language }}
                            </a>
                        </li>
                    @endif
                @endforeach

                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        {{$dd}}
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($currencies as $currency)
                            <li>
                                <a href="{{ route('changeCurrency', $currency->currencyID) }}" class="nav-link">
                                    {{ $currency->shortcut }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-0">
                        <i class="fas fa-user-circle"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle px-1" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->username }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item"
                           href="{{ route('mycart.route') }}">@lang('app.dropdown_e')</a>
                        <a class="dropdown-item"
                           href="{{ route('myprofile.route') }}">@lang('app.dropdown_a')</a>
                        <a class="dropdown-item"
                           href="{{ route('additemform.route') }}">@lang('app.dropdown_b')</a>
                        <a class="dropdown-item"
                           href="{{ route('myitemslist.route') }}">@lang('app.dropdown_c')</a>

                        @role('super_admin')
                        <a class="dropdown-item"
                           href="{{ route('dashboard') }}">@lang('app.dropdown_f')</a>
                        @endrole

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                            @lang('app.dropdown_d')
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        @endguest
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('homelink') }}">@lang('app.brand')</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @foreach($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link navbar-brand"
                               href="{{ route('catgory.route', $category->id) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<script src="{{ asset('js/plugins.js') }}" defer></script>
</body>
</html>
