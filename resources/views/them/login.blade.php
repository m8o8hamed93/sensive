@extends('them.master')
@section('title','login')
@section('content')

@include('them.partials.hero',['title' => 'Login'])

<!-- ================ contact section start ================= -->
<section class="section-margin--small section-margin">
  <div class="container">
    <div class="row">
      <div class="col-6 mx-auto">
        <form class="form-contact contact_form" method="POST" action="{{ route('login') }}" id="contactForm" novalidate="novalidate">
          @csrf
          <div class="form-group">
            <input class="form-control border" name="email" id="email" type="email" value="{{ old('email') }}" placeholder="Enter email address">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>
          <div class="form-group">
            <input class="form-control border" name="password" id="name" type="password" placeholder="Enter your password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>
          <div class="form-group text-center text-md-right mt-3">
            <a href="{{ route('register') }}" class="mx-3">Sign UP Instead</a>
            <button type="submit" class="button button--active button-contactForm">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- ================ contact section end ================= -->
@endsection