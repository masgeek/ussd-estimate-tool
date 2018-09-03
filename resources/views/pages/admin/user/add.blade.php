@extends('layouts.form')

@section('form')
    @component('components.controls.form', [
            'title'=>'Create a new User',
            'action'=>'user.store',
            'back'=>'clients.show',
            'btn_text'=>'CREATE USER'
    ])
        @component('components.controls.textInput',[
                 'id'=>'',
                 'name'=>'name',
                 'placeholder'=>'e.g John Doe',
                 'icon'=>'icon-user',
                 'label'=>'Name:'
         ])
        @endcomponent
        @component('components.controls.textInput',[
                 'id'=>'',
                 'name'=>'phone',
                 'placeholder'=>'e.g 0723XXXXXX',
                 'icon'=>'icon-phone2',
                 'label'=>'Mobile no:'
         ])
        @endcomponent

        @component('components.controls.dropDown',[
                 'name'=>'school_id',
                 'label'=>'School:',
                 'data'=>$schools
         ])
        @endcomponent

        @component('components.controls.dropDown',[
                 'name'=>'role',
                 'label'=>'Role:',
                 'data'=>$roles
         ])
        @endcomponent

        @component('components.controls.emailInput',[
                 'id'=>'',
                 'name'=>'email',
                 'placeholder'=>'e.g john@example.com',
                 'label'=>'Email address:'
         ])
        @endcomponent
        @component('components.controls.emailInput',[
                 'id'=>'',
                 'name'=>'email_confirmation',
                 'placeholder'=>'e.g john@example.com',
                 'label'=>'Confirm email address:'
         ])
        @endcomponent
    @endcomponent
@endsection
