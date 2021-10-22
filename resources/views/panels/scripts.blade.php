<!-- BEGIN VENDOR JS-->
<script src="{{asset('js/vendors.min.js')}}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
@yield('vendor-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/search.js')}}"></script>
<script src="{{asset('js/custom/custom-script.js')}}"></script>
<script src="{{ asset('js/vue/vue.js') }}"></script>
<script src="{{ asset('js/vue-resource/dist/vue-resource.js') }}"></script>
<script src="{{ asset('js/vue/vue-config.js') }}"></script>
<script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{ asset('js/PDFObject/PDFObject.js') }}"></script>
<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
@yield('page-script')