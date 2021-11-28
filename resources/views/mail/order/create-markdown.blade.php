@component('mail::message')

Hi {{ $order["name"] }}

Your order is placed successfully

@component('mail::panel')
Invoice Number : {{$order['invoice']}}
@endcomponent

@component('mail::panel')
Total Amount : ${{$order['amount']}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent