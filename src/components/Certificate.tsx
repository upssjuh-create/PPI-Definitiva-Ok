import React from 'react';
import { Event } from '../App';

interface CertificateProps {
  event: Event;
  onBack: () => void;
  onLogout: () => void;
}

export const Certificate: React.FC<CertificateProps> = ({
  event,
  onBack,
  onLogout,
}) => {
  return (
    <div className="min-h-screen bg-gray-50 p-6">
      <div className="max-w-4xl mx-auto">
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
          <h2 className="text-2xl font-bold mb-4">Certificado</h2>
          <p className="mb-4">Evento: {event.title}</p>
          <div className="border-2 border-gray-300 p-8 text-center">
            <h3 className="text-3xl font-bold mb-4">Certificado de Participação</h3>
            <p className="text-lg mb-2">Certificamos que</p>
            <p className="text-xl font-semibold mb-4">[Nome do Participante]</p>
            <p className="text-lg mb-2">participou do evento</p>
            <p className="text-xl font-semibold mb-4">{event.title}</p>
            <p className="text-sm text-gray-600">{event.date}</p>
          </div>
        </div>
      </div>
    </div>
  );
};

