<!DOCTYPE html>
<html lang="en" class="antialiased scroll-smooth p-0 m-0 box-border">

<head>
  @include('layout.head')
</head>

<body class="h-full max-w-full w-full overflow-x-hidden font-nunito">
  @include('layout.navbar')
  @yield('section')
  @include('layout.footer')
</body>

</html>