<!-- BEGIN: Default Header-->
@if (empty($pageConfigs['navbar_config']))
    <header>
        <nav class="navbar" id="navbar">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('site.home') }}">
                        <img alt="TimesPro | Career Carnival" src="{{ asset('images/logo.png') }}" class="logo">
                    </a>
                </div>
            </div>
        </nav>
    </header>
@endif
<!-- END: Default Header-->

<!-- BEGIN: Header with Back Button  -->
@if (!empty($pageConfigs['navbar_config']))
    @if ($pageConfigs['navbar_config']['type'] == 'back_btn_navbar')
        <header>
            <nav class="navbar" id="navbar">
                <div class="container d-block">
                    <div class="position-relative text-center">
                        <a href="{{ $pageConfigs['navbar_config']['backbtn_url'] }}" class="backArrow">
                            <img src="{{ asset('images/arrow-left.png') }}">
                        </a>
                        <h4 class="mb-0">{{ $pageConfigs['navbar_config']['title'] }}</h4>
                    </div>
                </div>
            </nav>
        </header>
    @endif
@endif
<!-- END: Header with Back Button  -->
