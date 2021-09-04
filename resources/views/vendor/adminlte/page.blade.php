@extends('adminlte::master')

@inject('layoutHelper', '\JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@if($layoutHelper->isLayoutTopnavEnabled())
    @php( $def_container_class = 'container' )
@else
    @php( $def_container_class = 'container-fluid' )
@endif

@section('adminlte_css')
    @stack('css')
    @yield('css')
    <style>
        th:hover {
            cursor: pointer;
        }
        .recruiter-view-link input:hover, .link-text input:hover {
            cursor: pointer;
        }
        .link-text, .link-text>input::placeholder {
            color: #17a2b8 !important;
        }

        li.has-treeview li.nav-item {
            margin-left: 15px;
        }
        li.has-treeview li.nav-item p {
            font-weight: 400 !important;
            font-size: 12px !important;
        }
        a.back-button {
            position: relative;
            top: 5px;
            align-self: flex-end;
            float: right;
            width: 100px;
        }
        .error {
            color: #ff0000 !important;
            font-weight: 300 !important;
            font-size: 12px !important;
        }
        .form-control.error {
            color: #000000 !important;
        }
        .intl-tel-input { display: block !important; }
        .intl-tel-input.allow-dropdown .selected-flag {
            height: 48px !important;
        }
        .divider { display: none; }
        .country.highlight { display: none; }
        .country { display: none; }
        .country.preferred { display: block; }
        .permissions-section {
            background-color: #efefef;
            border-radius: 5px;
            padding: 20px;
        }
        .job-description { height: auto; border: 0px none; }
    </style>
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        <div class="content-wrapper {{ config('adminlte.classes_content_wrapper') ?? '' }}">

            {{-- Content Header --}}
            <div class="content-header">
                <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                    @yield('content_header')
                </div>
            </div>

            {{-- Main Content --}}
            <div class="content">
                <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
                    @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                            <a href="javascript:void(0)" id="close_button" class="float-right text-white close_button">X</a>
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session()->get('error') }}
                            <a href="javascript:void(0)" id="close_button" class="float-right text-white close_button">X</a>
                        </div>
                    @endif
                    @if(session()->has('warning'))
                        <div class="alert alert-warning" role="alert">
                            {{ session()->get('warning') }}
                            <a href="javascript:void(0)" id="close_button" class="float-right text-white close_button">X</a>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>

        </div>

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
    <script>
        $(document).ready(function() {
            var input = $("#jquery-intl-phone");
            input.intlTelInput({
                onlyCountries: ['gb', 'us'],
                separateDialCode: false
            });
            input.on("countrychange", function() {
                input.val($('.dial-code').html)
            });
            /* $.validator.messages.required = function (param, input) {
                var title = $(input).attr('fieldTitle');
                return 'The ' + title + ' field is required.';
            } */
            $("#close_button").click(function() {
                $(".alert").hide();
            });
            
            setTimeout(() => {
                $(".alert").hide();
            }, 3000);
        });
    </script>
@stop
