<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>@yield('titletext')</title>

    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('essence/img/core-img/icon.png') }}">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{ asset('essence/css/core-style.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('essence/css/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('essence/style.css') }}">

    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css" type="text/css" media="all">

    <!-- FROM THIRD PARTY -->
    <!-- Bootstrap 3.3.7 -->
    <!-- <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}"> -->
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css') }}"> -->
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}"> -->
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="{{asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}"> -->
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Leaflet -->

    @yield('links')
    
</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="{{url('/shop')}}"><img src="{{ asset('essence/img/core-img/logo.png') }}" alt=""></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
               
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="{{url('/shop')}}">Shop</a>
                                <!-- <div class="megamenu">
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Women's Collection</li>
                                        <ul class=" cn-col-4">
                                            <li><a href="shop.html">Casual Dresses</a></li>
                                            <li><a href="shop.html">Blouses &amp; Shirts</a></li>
                                            <li><a href="shop.html">Rompers</a></li>
                                            <li><a href="shop.html">Pants & Shorts</a></li>
                                        </ul>
                                        <ul class=" cn-col-4">
                                            <li><a href="shop.html">Jackets & Cardigans</a></li>
                                            <li><a href="shop.html">Short Gowns</a></li>
                                            <li><a href="shop.html">Long & Ball Gowns</a></li>
                                        </ul>
                                        
                                        
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Men's Collection</li>
                                        <li><a href="shop.html">T-Shirts</a></li>
                                        <li><a href="shop.html">Polo</a></li>
                                        <li><a href="shop.html"></a></li>
                                        <li><a href="shop.html">Jackets</a></li>
                                        <li><a href="shop.html">Trench</a></li>
                                    </ul>
                                    <div class="single-mega cn-col-4">
                                        <img src="img/bg-img/bg-6.jpg" alt="">
                                    </div>
                                </div> -->
                            </li>
                            <!-- <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="shop.html">Shop</a></li>
                                    <li><a href="single-product-details.html">Product Details</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="single-blog.html">Single Blog</a></li>
                                    <li><a href="regular-page.html">Regular Page</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                </ul>
                            </li> -->
                            <li><a href="#">Boutiques</a>
                                @yield('boutiques')
                            </li>
                            <li><a href="{{url('/biddings')}}">Biddings</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
                
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                @guest
                @yield('auth') 
                @else
                @yield('search')
                @yield('favorites')
                @yield('transactions')
                @yield('cartbutton')
                @yield('userinfo')
                @yield('logout')
                
                @endguest
               
            </div>
                

        </div>
    </header>
    <!-- ##### Header Area End ##### -->


    @yield('cart')

    @yield('body')
    

    <!-- ##### Brands Area Start ##### -->
    <!-- <div class="brands-area d-flex align-items-center justify-content-between"> -->
        <!-- Brand Logo -->
        <!-- <div class="single-brands-logo">
            <img src="img/core-img/brand1.png" alt="">
        </div> -->
        <!-- Brand Logo -->
      <!--   <div class="single-brands-logo">
            <img src="img/core-img/brand2.png" alt="">
        </div> -->
        <!-- Brand Logo -->
      <!--   <div class="single-brands-logo">
            <img src="img/core-img/brand3.png" alt="">
        </div> -->
        <!-- Brand Logo -->
     <!--    <div class="single-brands-logo">
            <img src="img/core-img/brand4.png" alt="">
        </div> -->
        <!-- Brand Logo -->
        <!-- <div class="single-brands-logo">
            <img src="img/core-img/brand5.png" alt="">
        </div>
 -->        <!-- Brand Logo -->
        <!-- <div class="single-brands-logo">
            <img src="img/core-img/brand6.png" alt="">
        </div>
    </div> -->
    <!-- ##### Brands Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a href="{{url('/shop')}}"><img src="{{asset('essence/img/core-img/logo2.png')}}" alt=""></a>
                        </div>
                        @yield('footer_menu')
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area mb-30">
                        <ul class="footer_widget_menu">
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Payment Options</a></li>
                            <li><a href="#">Shipping and Delivery</a></li>
                            <li><a href="#">Guides</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms of Use</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_heading mb-30">
                            <h6>Subscribe</h6>
                        </div>
                        <div class="subscribtion_form">
                            <form action="#" method="post">
                                <input type="email" name="mail" class="mail" placeholder="Your email here">
                                <button type="submit" class="submit"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_social_area">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>

<div class="row mt-5">
                <div class="col-md-12 text-center">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Hinimo
    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>

        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="{{ asset('essence/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('essence/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('essence/js/bootstrap.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('essence/js/plugins.js') }}"></script>
    <!-- Classy Nav js -->
    <script src="{{ asset('essence/js/classy-nav.min.js') }}"></script>
    <!-- Active js -->
    <script src="{{ asset('essence/js/active.js') }}"></script>
    <!-- Paypal Script -->
    <!-- <script src="https://www.paypal.com/sdk/js?client-id=SB_CLIENT_ID"></script> -->
    <!-- Date Picker -->
<!--     <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script> -->
    <!-- bootstrap datepicker -->
    <script src="{{asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    
    @yield('script2')
    @yield('scripts')

</body>

</html>