@component('mail::message')
    # Dear {{ $user->f_name }},

    This is a notice to inform you that your appointment on the {{ date('d-m-Y', strtotime($visit->date)) }} with Dr.
    {{ $visit->doctor->user->f_name }} {{ $visit->doctor->user->l_name }} has been changed.

    The following are the updated details of your appointment:

    - Date: {{ date('d-m-Y', strtotime($visit->date)) }}
    - Time: {{ $visit->time }}
    - Cost: €{{ $visit->cost }}

    Regards,

    {{ config('app.name') }}

@endcomponent
