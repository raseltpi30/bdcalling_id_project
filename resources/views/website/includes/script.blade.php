 <!-- JavaScript Libraries -->

 <!-- <script src="{{ asset('website/assets/js/jquery.min.js') }}"></script> -->
 <script src="{{asset('backend')}}/plugins/jquery/jquery.min.js"></script>
 <script src="{{ asset('website/assets/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('website/assets/js/popper.min.js') }}"></script>
 <script src="{{ asset('website/assets/js/owl.carousel.min.js') }}"></script>
 <script src="{{ asset('website/assets/js/scripts.js') }}"></script>
 <script type="text/javascript" src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
 <script src="{{ asset('backend/plugins/sweetalert/sweetalert.min.js') }}"></script>

 <script>
     @if(Session::has('message'))
     var type = "{{Session::get('alert-type','info')}}"
     switch (type) {
         case 'info':
             toastr.info("{{ Session::get('message') }}");
             break;
         case 'success':
             toastr.success("{{ Session::get('message') }}");
             break;
         case 'warning':
             toastr.warning("{{ Session::get('message') }}");
             break;
         case 'error':
             toastr.error("{{ Session::get('message') }}");
             break;
     }
     @endif
 </script>