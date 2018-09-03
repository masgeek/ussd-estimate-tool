@extends('layouts.form')

@section('form')
    @component('components.controls.form', [
            'title'=>'Create a new client',
            'action'=>'client.store',
            'back'=>'clients.show',
            'btn_text'=>'CREATE CLIENT'
    ])
        @component('components.controls.textInput',[
                 'id'=>'',
                 'name'=>'name',
                 'placeholder'=>'e.g Kotlin High',
                 'icon'=>'icon-user',
                 'label'=>'Name:'
         ])
        @endcomponent
        @component('components.controls.textInput',[
                 'id'=>'pac-input',
                 'name'=>'location',
                 'placeholder'=>'Enter text to search',
                 'icon'=>'icon-location4',
                 'label'=>'Physical location:'
         ])
        @endcomponent
        @component('components.controls.dropDown',[
                 'name'=>'category',
                 'label'=>'Category:',
                 'data'=>config('menus.categories')
         ])
        @endcomponent
        @component('components.controls.dropDown',[
                 'name'=>'type',
                 'label'=>'Type:',
                 'data'=>config('menus.type')
         ])
        @endcomponent
        @component('components.controls.textInput',[
                 'id'=>'',
                 'name'=>'telephone_no',
                 'placeholder'=>'e.g 0723112XXX',
                 'icon'=>'icon-phone2',
                 'label'=>'Telephone no:'
         ])
        @endcomponent
        @component('components.controls.textArea',[
                 'id'=>'',
                 'name'=>'address',
                 'placeholder'=>'e.g P.O Box 123 - 30400',
                 'label'=>'Postal address:'
         ])
        @endcomponent
    @endcomponent
@endsection


@section('js')
    <script>
        function initAutocomplete() {
            // Set initial restrict to the greater list of countries.
            var input = document.getElementById('pac-input');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.setComponentRestrictions(
                {'country': ['ke']});
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDm0kE0HxlfcDH1xLqfNoHWOsSpp_DoIVg&libraries=places&callback=initAutocomplete" async defer></script>
@endsection
