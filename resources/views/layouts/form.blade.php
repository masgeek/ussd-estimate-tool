@extends('pages.index')


@section('js_css')


    <!-- Theme JS files -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/styling/uniform.min.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/pages/form_layouts.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/plugins/ui/ripple.min.js')}}"></script>

    <script>
        function initAutocomplete() {
            // Set initial restrict to the greater list of countries.
            var input = document.getElementById('pac-input');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.setComponentRestrictions(
                {'country': ['ke']});
        }
    </script>

    <!-- /theme JS files -->
@endsection

@section('navbar')
    @component('components.navbar.navbar')
    @endcomponent
@endsection

@section('content')

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @component('components.footer')@endcomponent

    </div>

@endsection