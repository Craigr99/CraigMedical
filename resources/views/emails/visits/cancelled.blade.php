@component('mail::message')
    # Dear {{ $user->f_name }},

    This is a notice to inform you that your appointment on the {{ date('d-m-Y', strtotime($visit->date)) }} with Dr.
    {{ $visit->doctor->user->f_name }} {{ $visit->doctor->user->l_name }} has been cancelled.

    We will be in contact with you to re-schedule your appointment to another suitable date.

    Regards,

    {{ config('app.name') }}

@endcomponent
