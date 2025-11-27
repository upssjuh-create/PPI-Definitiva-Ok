<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Code - {{ $event->title }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-[#1a5f3f] text-white shadow-lg no-print">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-bold">QR Code de Check-in</h1>
                <div class="flex items-center space-x-4">
                    <button onclick="window.history.back()" class="bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg transition">
                        Voltar
                    </button>
                    <button onclick="logout()" class="bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg transition">
                        Sair
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-8" id="qrcode-container">
                <h2 class="text-2xl font-bold text-center mb-6">QR Code de Check-in</h2>

                <!-- Informações do Evento -->
                <div class="mb-6 text-center">
                    <h3 class="text-xl font-semibold mb-2">{{ $event->title }}</h3>
                    <div class="text-gray-600 space-y-1">
                        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                        <p><strong>Horário:</strong> {{ $event->time }}</p>
                        <p><strong>Local:</strong> {{ $event->location }}</p>
                    </div>
                </div>

                <!-- QR Code -->
                <div class="flex justify-center mb-6">
                    <div class="bg-white p-4 rounded-lg border-2 border-gray-300">
                        <div id="qrcode"></div>
                    </div>
                </div>

                <!-- Código de Validação -->
                <div class="text-center mb-6">
                    <p class="text-sm text-gray-600 mb-2">Código de Validação:</p>
                    <div class="bg-gray-100 px-6 py-3 rounded-lg border-2 border-gray-300 inline-block">
                        <p class="text-2xl font-mono font-bold tracking-wider">{{ $event->check_in_code }}</p>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Use este código para check-in manual</p>
                </div>

                <!-- Instruções -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="font-semibold text-blue-900 mb-2">Instruções:</h4>
                    <ul class="text-sm text-blue-800 space-y-1 list-disc list-inside">
                        <li>Imprima este QR Code e coloque na entrada do evento</li>
                        <li>Os participantes podem escanear o QR Code para fazer check-in</li>
                        <li>Ou podem informar o código de validação manualmente</li>
                        <li>O código é único para este evento</li>
                    </ul>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="flex justify-center space-x-4 mt-6 no-print">
                <button onclick="downloadPDF()" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Baixar PDF</span>
                </button>
                <button onclick="window.print()" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span>Imprimir</span>
                </button>
            </div>
        </div>
    </main>

    <script>
        // Dados do evento
        const eventData = {
            eventId: {{ $event->id }},
            eventTitle: "{{ $event->title }}",
            checkInCode: "{{ $event->check_in_code }}",
            type: "check-in"
        };

        // Gerar QR Code
        new QRCode(document.getElementById("qrcode"), {
            text: JSON.stringify(eventData),
            width: 300,
            height: 300,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        // Função para baixar PDF
        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4'
            });

            // Título
            pdf.setFontSize(20);
            pdf.setFont('helvetica', 'bold');
            pdf.text('QR Code de Check-in', 105, 20, { align: 'center' });

            // Nome do evento
            pdf.setFontSize(14);
            pdf.setFont('helvetica', 'normal');
            const eventTitle = pdf.splitTextToSize("{{ $event->title }}", 170);
            pdf.text(eventTitle, 105, 35, { align: 'center' });

            // Informações do evento
            pdf.setFontSize(10);
            pdf.text('Data: {{ \Carbon\Carbon::parse($event->date)->format("d/m/Y") }}', 105, 50, { align: 'center' });
            pdf.text('Horário: {{ $event->time }}', 105, 57, { align: 'center' });
            pdf.text('Local: {{ $event->location }}', 105, 64, { align: 'center' });

            // QR Code
            const qrCanvas = document.querySelector('#qrcode canvas');
            if (qrCanvas) {
                const qrImage = qrCanvas.toDataURL('image/png');
                pdf.addImage(qrImage, 'PNG', 55, 75, 100, 100);
            }

            // Código de validação
            pdf.setFontSize(12);
            pdf.setFont('helvetica', 'bold');
            pdf.text('Código de Validação:', 105, 190, { align: 'center' });
            
            pdf.setFontSize(16);
            pdf.setFont('courier', 'bold');
            pdf.text('{{ $event->check_in_code }}', 105, 200, { align: 'center' });

            // Instruções
            pdf.setFontSize(9);
            pdf.setFont('helvetica', 'normal');
            pdf.text('Escaneie o QR Code ou digite o código acima para fazer check-in', 105, 215, { align: 'center' });

            // Rodapé
            pdf.setFontSize(8);
            pdf.setTextColor(128, 128, 128);
            pdf.text('Sistema de Eventos - IFFar', 105, 280, { align: 'center' });

            // Salvar PDF
            const fileName = 'qrcode-checkin-{{ Str::slug($event->title) }}.pdf';
            pdf.save(fileName);
        }

        function logout() {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
    </script>
</body>
</html>
