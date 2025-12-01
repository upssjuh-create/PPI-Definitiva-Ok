import React, { useState, useRef } from 'react';
import jsQR from 'jsqr';

interface CheckInProps {
  onBack: () => void;
  onLogout: () => void;
  onCheckInSuccess: () => void;
}

export const CheckIn: React.FC<CheckInProps> = ({
  onBack,
  onLogout,
  onCheckInSuccess,
}) => {
  const [mode, setMode] = useState<'scan' | 'manual'>('scan');
  const [manualCode, setManualCode] = useState('');
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const [scanning, setScanning] = useState(false);
  
  const videoRef = useRef<HTMLVideoElement>(null);
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const streamRef = useRef<MediaStream | null>(null);

  const startScanning = async () => {
    try {
      setError('');
      setScanning(true);
      
      const stream = await navigator.mediaDevices.getUserMedia({
        video: { facingMode: 'environment' }
      });
      
      streamRef.current = stream;
      
      if (videoRef.current) {
        videoRef.current.srcObject = stream;
        videoRef.current.play();
        scanQRCode();
      }
    } catch (err) {
      setError('Erro ao acessar câmera. Verifique as permissões.');
      setScanning(false);
    }
  };

  const stopScanning = () => {
    if (streamRef.current) {
      streamRef.current.getTracks().forEach(track => track.stop());
      streamRef.current = null;
    }
    setScanning(false);
  };

  const scanQRCode = () => {
    if (!videoRef.current || !canvasRef.current || !scanning) return;

    const video = videoRef.current;
    const canvas = canvasRef.current;
    const context = canvas.getContext('2d');

    if (!context) return;

    if (video.readyState === video.HAVE_ENOUGH_DATA) {
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      context.drawImage(video, 0, 0, canvas.width, canvas.height);

      const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
      const code = jsQR(imageData.data, imageData.width, imageData.height);

      if (code) {
        stopScanning();
        handleQRCodeDetected(code.data);
        return;
      }
    }

    requestAnimationFrame(scanQRCode);
  };

  const handleQRCodeDetected = async (qrData: string) => {
    try {
      const data = JSON.parse(qrData);
      
      if (data.type === 'check-in' && data.checkInCode) {
        await processCheckIn(data.eventId, data.checkInCode);
      } else {
        setError('QR Code inválido. Use o QR Code do evento.');
      }
    } catch (err) {
      setError('Erro ao processar QR Code.');
    }
  };

  const handleManualCheckIn = async (e: React.FormEvent) => {
    e.preventDefault();
    
    if (!manualCode.trim()) {
      setError('Digite o código de check-in');
      return;
    }

    // Extrair eventId do código (formato: eventId-CODIGO)
    const parts = manualCode.split('-');
    if (parts.length !== 2) {
      setError('Código inválido. Use o formato correto.');
      return;
    }

    const eventId = parseInt(parts[0]);
    await processCheckIn(eventId, manualCode);
  };

  const processCheckIn = async (eventId: number, checkInCode: string) => {
    setLoading(true);
    setError('');
    setSuccess('');

    try {
      const token = localStorage.getItem('auth_token');
      const response = await fetch(`${import.meta.env.VITE_API_URL || 'http://localhost:8000/api'}/events/${eventId}/check-in`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`,
        },
        body: JSON.stringify({ check_in_code: checkInCode }),
      });

      const data = await response.json();

      if (!response.ok) {
        throw new Error(data.message || 'Erro ao fazer check-in');
      }

      setSuccess(`Check-in realizado com sucesso! Evento: ${data.event?.title || ''}`);
      setTimeout(() => {
        onCheckInSuccess();
      }, 2000);
    } catch (err: any) {
      setError(err.message || 'Erro ao fazer check-in');
    } finally {
      setLoading(false);
    }
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

        <div className="bg-white rounded-lg shadow-md p-6">
          <h2 className="text-2xl font-bold mb-6 text-center">Check-in no Evento</h2>

          {/* Seletor de Modo */}
          <div className="flex space-x-4 mb-6">
            <button
              onClick={() => {
                setMode('scan');
                setError('');
                setSuccess('');
              }}
              className={`flex-1 py-3 rounded-lg font-semibold ${
                mode === 'scan'
                  ? 'bg-blue-500 text-white'
                  : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
              }`}
            >
              Escanear QR Code
            </button>
            <button
              onClick={() => {
                setMode('manual');
                stopScanning();
                setError('');
                setSuccess('');
              }}
              className={`flex-1 py-3 rounded-lg font-semibold ${
                mode === 'manual'
                  ? 'bg-blue-500 text-white'
                  : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
              }`}
            >
              Código Manual
            </button>
          </div>

          {/* Modo Escanear */}
          {mode === 'scan' && (
            <div className="space-y-4">
              {!scanning ? (
                <button
                  onClick={startScanning}
                  className="w-full bg-green-500 text-white py-4 rounded-lg hover:bg-green-600 flex items-center justify-center space-x-2"
                >
                  <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  <span>Iniciar Câmera</span>
                </button>
              ) : (
                <div className="space-y-4">
                  <div className="relative bg-black rounded-lg overflow-hidden">
                    <video
                      ref={videoRef}
                      className="w-full"
                      playsInline
                    />
                    <canvas ref={canvasRef} className="hidden" />
                    <div className="absolute inset-0 border-4 border-green-500 pointer-events-none">
                      <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-48 h-48 border-2 border-white"></div>
                    </div>
                  </div>
                  <button
                    onClick={stopScanning}
                    className="w-full bg-red-500 text-white py-3 rounded-lg hover:bg-red-600"
                  >
                    Parar Câmera
                  </button>
                  <p className="text-center text-sm text-gray-600">
                    Aponte a câmera para o QR Code do evento
                  </p>
                </div>
              )}
            </div>
          )}

          {/* Modo Manual */}
          {mode === 'manual' && (
            <form onSubmit={handleManualCheckIn} className="space-y-4">
              <div>
                <label className="block mb-2 font-semibold">Código de Check-in</label>
                <input
                  type="text"
                  value={manualCode}
                  onChange={(e) => setManualCode(e.target.value.toUpperCase())}
                  placeholder="Ex: 1-A3F7B2C9"
                  className="w-full border rounded-lg px-4 py-3 text-center text-lg font-mono"
                  disabled={loading}
                />
                <p className="text-sm text-gray-600 mt-2">
                  Digite o código que está abaixo do QR Code
                </p>
              </div>
              <button
                type="submit"
                disabled={loading}
                className="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 disabled:bg-gray-400"
              >
                {loading ? 'Processando...' : 'Fazer Check-in'}
              </button>
            </form>
          )}

          {/* Mensagens */}
          {error && (
            <div className="mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
              {error}
            </div>
          )}

          {success && (
            <div className="mt-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
              {success}
            </div>
          )}

          {/* Instruções */}
          <div className="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h4 className="font-semibold text-blue-900 mb-2">Como fazer check-in:</h4>
            <ul className="text-sm text-blue-800 space-y-1 list-disc list-inside">
              <li>Escaneie o QR Code na entrada do evento</li>
              <li>Ou digite o código manualmente</li>
              <li>Você precisa estar inscrito no evento</li>
              <li>O check-in só pode ser feito uma vez</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  );
};
