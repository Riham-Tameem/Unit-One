
@component('mail::message')
    <h1> {{$details['title']}} </h1>
    <p> {!! $details['message'] !!}</p>
@endcomponent
