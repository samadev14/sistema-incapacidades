{{-- Vista para mostrar la notificación en el correo electrónico corporativo del empleado --}}
<x-mail::message>
# ¡Hola, {{ $fullName }}!

<x-mail::panel>
> Esta notificación ha llegado a tu bandeja de mensajes para informarte sobre el estado de la incapacidad que has solicitado:

### Observaciones: 
> {{ $message }}
</x-mail::panel>

Gracias por su atención<br>
Atte.<br>
Departamento de Recursos Humanos
</x-mail::message>