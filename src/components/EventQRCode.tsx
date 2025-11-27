import React, { useEffect, useRef, useState } from 'react';
import QRCode from 'qrcode';
import jsPDF from 'jspdf';
import { Event } from '../App';

interface EventQRCodeProps {
  event: Event;
  onBack: () => void;
  onLogout: () => void;
}

export const EventQRCode: React.FC<EventQRCodeProps> = ({
  event,
  onBack,
  onLogout,
}) => {
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const [checkInCode, setCheckInCode] = useState<string>('');

  useEffect(() => {
    // Gerar código único para o evento (se não existir)
    const code = event.checkInCode || generateCheckInCode();
    setCheckInCode(code);

    // Gerar QR Code
    if (canvasRef.current) {
      const qrData = JSON.stringify({
        eventId: event.id,
        eventTitle: event.title,
        checkInCode: code,
        type: 'check-in',
      });

      QRCode.toCanvas(canvasRef.current, qrData, {
        width: 300,
        margin: 2,
        color: {
          dark: '#000000',
          light: '#FFFFFF',
        },
      });
    }
  }, [event]);

  const generateCheckInCode = (): string => {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let code = '';
    for (let i = 0; i < 8; i++) {
      code += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return `${event.id}-${code}`;
  };

  const downloadPDF = () => {
    const pdf = new jsPDF({
      orientation: 'portrait',
      unit: 'mm',
      format: 'a4',
    });

    // Título
    pdf.setFontSize(20);
    pdf.setFont('helvetica', 'bold');
    pdf.text('QR Code de Check-in', 105, 20, { align: 'center' });

    // Nome do evento
    pdf.setFontSize(14);
    pdf.setFont('helvetica', 'normal');
    const eventTitle = pdf.splitTextToSize(event.title, 170);
    pdf.text(eventTitle, 105, 35, { align: 'center' });

    // Informações do evento
    pdf.setFontSize(10);
    pdf.text(`Data: ${event.date}`, 105, 50, { align: 'center' });
    pdf.text(`Horário: ${event.time}`, 105, 57, { align: 'center' });
    pdf.text(`Local: ${event.location}`, 105, 64, { align: 'center' });

    // QR Code
    if (canvasRef.current) {
      const qrImage = canvasRef.current.toDataURL('image/png');
      pdf.addImage(qrImage, 'PNG', 55, 75, 100, 100);
    }

    // Código de validação
    pdf.setFontSize(12);
    pdf.setFont('helvetica', 'bold');
    pdf.text('Código de Validação:', 105, 190, { align: 'center' });
    
    pdf.setFontSize(16);
    pdf.setFont('courier', 'bold');
    pdf.text(checkInCode, 105, 200, { align: 'center' });

    // Instruções
    pdf.setFontSize(9);
    pdf.setFont('helvetica', 'normal');
    pdf.text('Escaneie o QR Code ou digite o código acima para fazer check-in', 105, 215, { align: 'center' });

    // Rodapé
    pdf.setFontSize(8);
    pdf.setTextColor(128, 128, 128);
    pdf.text('Sistema de Eventos - IFFar', 105, 280, { align: 'center' });

    // Salvar PDF
    const fileName = `qrcode-checkin-${event.title.replace(/[^a-z0-9]/gi, '-').toLowerCase()}.pdf`;
    pdf.save(fileName);
  };

  return (
    <div className="min-h-screen bg-gray-50 p-6">
      <div className="max-w-2xl mx-auto">
        <div className="flex justify-between items-center mb-6">
          <button
            onClick={onBack}
            className="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600"
          >
            Voltar
          </button>
          <button
            onClick={onLogout}
            className="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600"
          >
            Sair
          </button>
        </div>

        <div className="bg-white rounded-lg shadow-md p-8">
          <h2 className="text-2xl font-bold mb-6 text-center">
            QR Code de Check-in
          </h2>

          <div className="mb-6">
            <h3 className="text-xl font-semibold mb-2">{event.title}</h3>
            <div className="text-gray-600 space-y-1">
              <p><strong>Data:</strong> {event.date}</p>
              <p><strong>Horário:</strong> {event.time}</p>
              <p><strong>Local:</strong> {event.location}</p>
            </div>
          </div>

          <div className="flex flex-col items-center space-y-6">
            {/* QR Code */}
            <div className="bg-white p-4 rounded-lg border-2 border-gray-300">
              <canvas ref={canvasRef}></canvas>
            </div>

            {/* Código de Validação */}
            <div className="text-center">
              <p className="text-sm text-gray-600 mb-2">Código de Validação:</p>
              <div className="bg-gray-100 px-6 py-3 rounded-lg border-2 border-gray-300">
                <p className="text-2xl font-mono font-bold tracking-wider">
                  {checkInCode}
                </p>
              </div>
              <p className="text-xs text-gray-500 mt-2">
                Use este código para check-in manual
              </p>
            </div>

            {/* Botão de Download */}
            <button
              onClick={downloadPDF}
              className="bg-green-500 text-white px-8 py-3 rounded-lg hover:bg-green-600 flex items-center space-x-2"
            >
              <svg
                className="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                />
              </svg>
              <span>Baixar PDF</span>
            </button>

            {/* Instruções */}
            <div className="bg-blue-50 border border-blue-200 rounded-lg p-4 w-full">
              <h4 className="font-semibold text-blue-900 mb-2">Instruções:</h4>
              <ul className="text-sm text-blue-800 space-y-1 list-disc list-inside">
                <li>Imprima este QR Code e coloque na entrada do evento</li>
                <li>Os participantes podem escanear o QR Code para fazer check-in</li>
                <li>Ou podem informar o código de validação manualmente</li>
                <li>O código é único para este evento</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};
