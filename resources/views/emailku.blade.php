<x-mail::message>
# Introduction

{{ $data['title'] }}

<x-mail::button :url="$data['url']">
    Button Text
</x-mail::button>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
