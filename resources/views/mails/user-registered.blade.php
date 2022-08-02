@component('mail::message')
# Introduction

- list item 1
- list item 2

User Registered

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
