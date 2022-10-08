@extends('layouts.frontend.include.master')
@section('title')
    @yield('Welcome to PhoneBook')
@endsection

@section('content')
    @include('layouts.frontend.include.slider')
    <div class="contact-list margin-top-10 margin-bottom-10">
        <h1 class="header margin-bottom-10"> New Contact List </h1>
        @include('layouts.frontend.include.allContactList')
    </div>
    {{-- @include('layouts.frontend.include.footer') --}}
@endsection
