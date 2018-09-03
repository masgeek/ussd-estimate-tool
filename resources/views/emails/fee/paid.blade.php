@component('mail::message')

# {{ $content['title'] }}

{{"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tristique massa magna, nec aliquam nisl tempor hendrerit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent iaculis dui convallis arcu convallis malesuada. "}}

Thanks,<br>
{{ '**'.Auth::user()->name.'**'}}<br>
{{'Accountant - '.Auth::user()->staff->school->name}}
@endcomponent