@extends('layouts.form')

<?php
$events = [
    ['name' => 'meeting', 'value' => 'Meeting'],
    ['name' => 'reminder', 'value' => 'Reminder'],
    ['name' => 'announcement', 'value' => 'Announcement'],
    ['name' => 'other', 'value' => 'Other']
];


?>

@section('js_css')

    <!-- Date picker -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/notifications/jgrowl.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/ui/moment/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/pickers/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/pickers/pickadate/picker.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/pickers/pickadate/picker.date.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/pickers/pickadate/picker.time.js')}}"></script>
    <!-- Date picker -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/styling/uniform.min.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/pages/form_layouts.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/pages/picker_date.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->


@endsection

@section('form')
    @component('components.controls.form', [
            'title'=>'Create a new Event',
            'action'=>'event.add',
            'back'=>'events.show',
            'btn_text'=>'CREATE EVENT'
    ])
        @component('components.controls.textInput',[
                 'id'=>'',
                 'name'=>'title',
                 'placeholder'=>'e.g Annual general meeting',
                 'icon'=>' icon-bookmark2',
                 'label'=>'Title:'
         ])
        @endcomponent

        @component('components.controls.dropDown',[
                 'name'=>'event_type',
                 'label'=>'Event type:',
                 'data'=>$events
         ])
        @endcomponent

        @component('components.controls.datePicker',[
                 'id'=>'',
                 'name'=>'event_date',
                 'placeholder'=>'Select a date',
                 'icon'=>' icon-calendar2',
                 'label'=>'Event date:'
         ])
        @endcomponent

        @component('components.controls.timePicker',[
                 'id'=>'',
                 'name'=>'event_time',
                 'placeholder'=>'Select the start time',
                 'icon'=>' icon-alarm',
                 'label'=>'Start time:'
         ])
        @endcomponent

        @component('components.controls.textArea',[
                 'id'=>'',
                 'name'=>'description',
                 'placeholder'=>'Enter a brief description of the event here',
                 'label'=>'Description:'
         ])
        @endcomponent
    @endcomponent
@endsection
