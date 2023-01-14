@php $titlePage = 'Login'; @endphp

@extends('auth.master')

@section('title', $titlePage)

@section('content')
    <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
        @csrf

        <span class="login100-form-title p-b-26">{{ $titlePage }}</span>

        @include('dashboard.components.flash_msg')
        <div class="wrap-input100 validate-input">
            <input class="input100" type="email" name="email" autocomplete="off">
            <span class="focus-input100" data-placeholder="Email"></span>
        </div>

        <div class="wrap-input100 validate-input">
            <input class="input100" type="password" name="password" autocomplete="off">
            <span class="focus-input100" data-placeholder="Password"></span>
        </div>

        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn">
                    {{ $titlePage }}
                </button>
            </div>
        </div>

        <div class="text-center p-t-115">
            <span class="txt1">Don’t have an account?</span>
            <a class="txt2" href="{{ route('register') }}">Sign Up</a>
        </div>
    </form>
@endsection
