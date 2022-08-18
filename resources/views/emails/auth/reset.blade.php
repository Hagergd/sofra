@component('mail::message')


# hi {{$user->name}}


<P> Your Blood Bank code is {{$user->pin_code}}</P>

@component('mail::button', ['url' => 'gogoyoyo646@gmail.com'])
View Order
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent
