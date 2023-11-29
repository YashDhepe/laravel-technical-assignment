{{-- BEGIN: Bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
{{-- END: Bootstrap --}}

{{-- BEGIN: Fonts --}}
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
{{-- END: Fonts --}}

{{-- BEGIN: Custom styles --}}
<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
{{-- END: Custom styles --}}

{{-- BEGIN: Slick Slider --}}
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
{{-- END: Slick Slider --}}

{{-- BEGIN: Page Styles --}}
@yield('page-style')
{{-- RND: Page Styles --}}