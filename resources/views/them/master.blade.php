<!DOCTYPE html>
<html lang="en">
    @include('them.partials.head')

<body>
  <!--================Header Menu Area =================-->
@include('them.partials.header')
  <!--================Header Menu Area =================-->
  
  @yield('content')
  <!--================ Start Footer Area =================-->
  @include('them.partials.footer')

  <!--================ End Footer Area =================-->
  @include('them.partials.scripts')

  
</body>
</html>