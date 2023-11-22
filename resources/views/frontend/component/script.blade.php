<!-- jQuery (Necessary for All JavaScript Plugins) -->
<script src="{{asset('frontend/assets/js/jquery.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/popper.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/jquery.easing.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/classy-nav.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/owl.carousel.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/scrollup.js')}} "></script>
<script src="{{asset('frontend/assets/js/waypoints.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/jquery.countdown.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/jquery.counterup.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/jquery-ui.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/jarallax.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/jarallax-video.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/jquery.magnific-popup.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/jquery.nice-select.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/wow.min.js')}} "></script>
<script src="{{asset('frontend/assets/js/active.js')}} "></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('frontend/assets/js/script.js')}} "></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    setTimeout(() => {
        $('#alert').slideUp();
    }, 8000);
</script>
@yield('script')