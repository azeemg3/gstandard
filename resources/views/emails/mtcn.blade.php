@component('mail::message')

**From Branch:** {{ $details['from_branch'] }}  
**To Branch:** {{ $details['to_branch'] }}  

---

### Message:
{{ $details['message'] }}

---

Thanks,  
{{ config('app.name') }}
@endcomponent
