<!DOCTYPE html>
<html lang="en">

<head>
@include('front.layout.header_meta')

</head>

<body>
    <!-- ##### Header Area Start ##### -->
   @include('front.layout.header')
    <!-- ##### Hero Area Start ##### -->

    @yield('content')

    <!-- ##### Hero Area End ##### -->

    <!-- ##### Welcome Slide Area Start ##### -->

    <!-- ##### Welcome Slide Area End ##### -->

    <!-- ##### Blog Post Area Start ##### -->

    <!-- ##### Blog Post Area End ##### -->

    <!-- ##### Footer Area Start ##### -->


   @include('front.layout.footer')

    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Files ##### -->
  @include('front.layout.footer_meta')
</body>

</html>
