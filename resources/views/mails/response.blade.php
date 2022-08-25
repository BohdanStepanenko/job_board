Hello {{ $response->receiver }},

I`m interested of

Vacancy: {{ $response->title }}
Date: {{ $response->date }}

Total responses: {{ $response->responses_count }}

Thank You,
{{ $response->sender }}
