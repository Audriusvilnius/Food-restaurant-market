@inject('basket', 'App\Services\BasketService')
@inject('restaurant', 'App\Services\RestaurantService')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">


    <!-- Scripts -->
    @vite(['resources/sass/back/app.scss', 'resources/js/back/app.js'])

    <style>
        /* #rating-score {
            display: flex;
            justify-content: center;
            width: 12.5%;
        }

        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .radio-input {
            position: fixed;
            opacity: 0;
            pointer-events: none;
        }

        .radio-label {
            cursor: pointer;
            font-size: 0;
            color: rgba(0, 0, 0, 0.2);
            transition: color 0.1s ease-in-out;
        }

        .radio-label:before {
            content: "★";
            display: inline-block;
            font-size: 32px;
        }

        .radio-input:checked~.radio-label {
            color: #ffc700;
            color: gold;
        }

        .radio-label:hover,
        .radio-label:hover~.radio-label {
            color: goldenrod;
        }

        .radio-input:checked+.radio-label:hover,
        .radio-input:checked+.radio-label:hover~.radio-label,
        .radio-input:checked~.radio-label:hover,
        .radio-input:checked~.radio-label:hover~.radio-label,
        .radio-label:hover~.radio-input:checked~.radio-label {
            color: darkgoldenrod;
        } */


        .average-rating {
            position: relative;
            appearance: none;
            color: transparent;
            width: auto;
            display: inline-block;
            vertical-align: baseline;
            font-size: 25px;
        }

        .average-rating::before {
            --percent: calc( {
                        {
                        $food->rating
                    }
                }

                /5*100%);
            content: '★★★★★';
            position: absolute;
            top: 0;
            left: 0;
            color: rgba(0, 0, 0, 0.2);
            background: linear-gradient(90deg, gold var(--percent), rgba(0, 0, 0, 0.2) var(--percent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

    </style>
</head>

<body>
    <div id="app ">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">{{--fixed-top--}}
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logo" src="{{ asset('/images/temp/exam.png') }}" alt="exam">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--Lang-->
                <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                        @include('partials/language_switcher')
                    </div>
                </div>
                <!--Lang-->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    {{-- @include('front.home.common.restaurant') --}}
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        @if(Auth::user()?->role == 'admin')
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Orders') }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('order-index') }}">{{__('Order list')  }}</a>

                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{__('Foods') }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('foods-index') }}">{{__('Foods') }}</a>
                                <a class="dropdown-item" href="{{ route('category-index') }}">{{__('Categories') }}</a>


                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{__('Restaurant') }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('restaurants-index') }}">{{__('Restaurants') }}</a>
                                <a class="dropdown-item" href="{{ route('city-index') }}">{{__('Cities') }}</a>
                                <a class="dropdown-item" href="{{ route('foods-rest_title') }}">{{__('Copy Restaurant title')  }}</a>


                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{__('Owners') }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('ovner-create') }}">{{__('Add new')  }}</a>
                                <a class="dropdown-item" href="{{ route('ovner-index') }}">{{__('List') }}</a>
                            </div>
                        </li>

                        @endif

                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                        <a href="{{ route('view-basket') }}">
                            <svg class="cart">
                                <use xlink:href="#cart"></use>
                            </svg>
                        </a>

                        @if($basket->count!=0)
                        <div class="ithem">
                            {{-- <span>{{$basket->test()}}</span> --}}
                            @if($basket->count<=9) <span>{{$basket->count}}</span>
                                @elseif($basket->count>9) 9+@endif
                        </div>
                        <li class="nav-link">{{__('Total') }}: <b>{{number_format((float)$basket->total, 2, '.', '')}} &euro;</b></li>
                    </ul>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    @include('layouts.svg')
    <main class=" py-4 mystyle">
        @yield('content')
    </main>
</body>

</html>
