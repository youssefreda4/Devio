<x-mail::message>
# Name: {{ $data['name'] }}

### Email: {{ $data['email'] }}

### Phone: {{ $data['phone'] }}

Message:  
{{ $data['message'] }}

Thanks,  
{{ config('app.name') }}
</x-mail::message>
