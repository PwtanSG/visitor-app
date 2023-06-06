@component('mail::message')
# Contact Form
To : {{ config('app.name') }}<br>
From <br>
Name : {{ $mailData['name'] }}<br>
Email : {{ $mailData['email'] }}<br>
Message : {{ $mailData['message'] }}<br>

@component('mail::button', ['url' => ''])
Find out more
@endcomponent

Thanks,<br>
@endcomponent
