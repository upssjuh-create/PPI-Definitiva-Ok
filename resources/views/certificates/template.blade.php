<!DOCTYPE html>
margin-bottom: 30px;
}
.student-name {
font-size: 36px;
color: #1a4d2e;
font-weight: bold;
margin: 30px 0;
border-bottom: 2px solid #1a4d2e;
display: inline-block;
padding-bottom: 10px;
}
.event-title {
font-size: 28px;
color: #333;
margin: 20px 0;
}
.details {
font-size: 18px;
color: #666;
margin: 30px 0;
line-height: 1.8;
}
.code {
font-size: 14px;
color: #999;
margin-top: 40px;
}
.footer {
margin-top: 60px;
display: flex;
justify-content: space-around;
}
.signature {
text-align: center;
}
.signature-line {
width: 250px;
border-top: 2px solid #1a4d2e;
margin: 0 auto 10px;
}
</style>
</head>
<body>
<div class="certificate">
<div class="header">CERTIFICADO</div>


<p style="font-size: 20px; color: #666;">Certificamos que</p>


<div class="student-name">{{ $user->name }}</div>


<p style="font-size: 18px; color: #666;">participou do evento</p>


<div class="event-title">{{ $event->title }}</div>


<div class="details">
<p>Realizado em {{ $event->date->format('d/m/Y') }}</p>
<p>Local: {{ $event->location }}</p>
@if($event->certificate_hours)
<p>Carga horária: {{ $event->certificate_hours }} horas</p>
@endif
</div>


@if($event->certificate_description)
<p style="font-size: 16px; color: #666; margin: 30px 0;">
{{ $event->certificate_description }}
</p>
@endif


<div class="footer">
<div class="signature">
<div class="signature-line"></div>
<p>{{ $event->organizer }}</p>
<p style="font-size: 14px; color: #999;">Organizador</p>
</div>
</div>


<div class="code">
<p>Código de Validação: {{ $certificate->certificate_code }}</p>
<p>Emitido em: {{ $certificate->issued_at->format('d/m/Y') }}</p>
<p style="font-size: 12px;">Valide este certificado em: https://seusite.com/validar</p>
</div>
</div>
</body>
</html>