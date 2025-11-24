<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Certificado - {{ $certificate->user->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            background: white;
            padding: 25px;
        }
        
        .certificate-container {
            border: 12px solid #1a5f3f;
            padding: 40px 60px;
            background: white;
            min-height: 150mm;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .logo {
            width: 60px;
            height: 60px;
            background: #1a5f3f;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 30px;
            font-weight: bold;
        }
        
        .institution {
            font-size: 18px;
            font-weight: bold;
            color: #1a5f3f;
            margin-bottom: 3px;
        }
        
        .campus {
            font-size: 12px;
            color: #666;
        }
        
        .certificate-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin: 20px 0 15px;
            padding: 15px 0;
            border-top: 3px solid #ddd;
            border-bottom: 3px solid #ddd;
        }
        
        .certificate-text {
            text-align: center;
            font-size: 13px;
            color: #666;
            margin-bottom: 15px;
        }
        
        .participant-name {
            font-size: 30px;
            font-weight: bold;
            color: #1a5f3f;
            padding-bottom: 8px;
            border-bottom: 2px solid #333;
            margin: 0 auto;
            display: inline-block;
        }
        
        .participant-name-container {
            text-align: center;
            width: 100%;
        }
        
        .event-description {
            text-align: center;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            margin: 20px 0;
        }
        
        .event-info {
            display: table;
            width: 100%;
            margin: 25px 0;
        }
        
        .info-item {
            display: table-cell;
            text-align: center;
            padding: 10px;
            width: 33.33%;
        }
        
        .info-icon {
            font-size: 20px;
            color: #1a5f3f;
            margin-bottom: 5px;
        }
        
        .info-label {
            font-size: 11px;
            color: #666;
            margin-bottom: 3px;
        }
        
        .info-value {
            font-size: 13px;
            font-weight: bold;
            color: #333;
        }
        
        .signatures {
            display: table;
            width: 100%;
            margin-top: 30px;
        }
        
        .signature {
            display: table-cell;
            text-align: center;
            padding: 0 30px;
            width: 50%;
        }
        
        .signature-line {
            border-bottom: 2px solid #333;
            margin-bottom: 8px;
            height: 40px;
        }
        
        .signature-name {
            font-size: 13px;
            font-weight: bold;
            color: #333;
            margin-bottom: 3px;
        }
        
        .signature-title {
            font-size: 11px;
            color: #666;
        }
        
        .validation {
            text-align: center;
            margin-top: 25px;
            padding: 12px;
            background: #f5f5f5;
            border-radius: 5px;
        }
        
        .validation-label {
            font-size: 11px;
            color: #666;
            margin-bottom: 3px;
        }
        
        .validation-code {
            font-size: 14px;
            font-weight: bold;
            color: #1a5f3f;
            font-family: 'Courier New', monospace;
            margin-bottom: 3px;
        }
        
        .validation-url {
            font-size: 9px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">🎓</div>
            <div class="institution">INSTITUTO FEDERAL FARROUPILHA</div>
            <div class="campus">Campus Panambi</div>
        </div>
        
        <!-- Certificate Title -->
        <div class="certificate-title">CERTIFICADO</div>
        
        <!-- Certificate Text -->
        <div class="certificate-text">Certificamos que</div>
        
        <!-- Participant Name -->
        <div class="participant-name-container" style="margin: 20px 0;">
            <span class="participant-name">{{ $certificate->user->name }}</span>
        </div>
        
        <!-- Event Description -->
        <div class="event-description">
            participou do evento <strong>{{ $certificate->event->title }}</strong>, 
            realizado em <strong>{{ $dataFormatada }}</strong>, 
            com carga horária de <strong>{{ $certificate->event->certificate_hours ?? 8 }} horas</strong>, 
            no <strong>{{ $certificate->event->location }}</strong>.
        </div>
        
        <!-- Event Info -->
        <div class="event-info">
            <div class="info-item">
                <div class="info-icon">📅</div>
                <div class="info-label">Data</div>
                <div class="info-value">{{ $dataFormatada }}</div>
            </div>
            <div class="info-item">
                <div class="info-icon">📍</div>
                <div class="info-label">Local</div>
                <div class="info-value">{{ $certificate->event->location }}</div>
            </div>
            <div class="info-item">
                <div class="info-icon">⏱️</div>
                <div class="info-label">Carga Horária</div>
                <div class="info-value">{{ $certificate->event->certificate_hours ?? 8 }} horas</div>
            </div>
        </div>
        
        <!-- Signatures -->
        <div class="signatures">
            <div class="signature">
                @if($certificate->event->signature1 && $certificate->event->signature1->image_path)
                    @php
                        $imagePath1 = storage_path('app/public/' . $certificate->event->signature1->image_path);
                        $imageBase641 = null;
                        if (file_exists($imagePath1)) {
                            try {
                                $imageData1 = base64_encode(file_get_contents($imagePath1));
                                $imageMime1 = mime_content_type($imagePath1);
                                $imageBase641 = 'data:' . $imageMime1 . ';base64,' . $imageData1;
                            } catch (\Exception $e) {
                                \Log::error('Erro ao carregar assinatura 1: ' . $e->getMessage());
                            }
                        }
                    @endphp
                    @if($imageBase641)
                    <div style="height: 60px; margin-bottom: 8px; text-align: center; display: table-cell; vertical-align: middle;">
                        <img src="{{ $imageBase641 }}" style="max-height: 50px; max-width: 180px; display: inline-block;">
                    </div>
                    @else
                    <div class="signature-line"></div>
                    @endif
                @else
                <div class="signature-line"></div>
                @endif
                <div class="signature-name">{{ $certificate->event->signature1->name ?? ($certificate->event->organizer ?? 'Coordenador') }}</div>
                <div class="signature-title">{{ $certificate->event->signature1->title ?? 'Coordenador do Evento' }}</div>
            </div>
            <div class="signature">
                @if($certificate->event->signature2 && $certificate->event->signature2->image_path)
                    @php
                        $imagePath2 = storage_path('app/public/' . $certificate->event->signature2->image_path);
                        $imageBase642 = null;
                        if (file_exists($imagePath2)) {
                            try {
                                $imageData2 = base64_encode(file_get_contents($imagePath2));
                                $imageMime2 = mime_content_type($imagePath2);
                                $imageBase642 = 'data:' . $imageMime2 . ';base64,' . $imageData2;
                            } catch (\Exception $e) {
                                \Log::error('Erro ao carregar assinatura 2: ' . $e->getMessage());
                            }
                        }
                    @endphp
                    @if($imageBase642)
                    <div style="height: 60px; margin-bottom: 8px; text-align: center; display: table-cell; vertical-align: middle;">
                        <img src="{{ $imageBase642 }}" style="max-height: 50px; max-width: 180px; display: inline-block;">
                    </div>
                    @else
                    <div class="signature-line"></div>
                    @endif
                @else
                <div class="signature-line"></div>
                @endif
                <div class="signature-name">{{ $certificate->event->signature2->name ?? 'Diretor(a)' }}</div>
                <div class="signature-title">{{ $certificate->event->signature2->title ?? 'Direção de Ensino' }}</div>
            </div>
        </div>
        
        <!-- Validation Code -->
        <div class="validation">
            <div class="validation-label">Código de Validação</div>
            <div class="validation-code">{{ $certificate->certificate_code }}</div>
            <div class="validation-url">Valide este certificado em: eventos.iffar.edu.br/validar</div>
        </div>
    </div>
</body>
</html>
