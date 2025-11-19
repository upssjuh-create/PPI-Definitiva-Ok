import React from 'react';
import { Event } from '../App';

interface PaymentProps {
  event: Event;
  onBack: () => void;
  onComplete: () => void;
  onLogout: () => void;
}

export const Payment: React.FC<PaymentProps> = ({
  event,
  onBack,
  onComplete,
  onLogout,
}) => {
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
          <h2 className="text-2xl font-bold mb-4">Pagamento</h2>
          <p className="mb-4">Evento: {event.title}</p>
          <p className="mb-4">Valor: R$ {event.price.toFixed(2)}</p>
          <div className="space-y-4">
            <button
              onClick={onComplete}
              className="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 w-full"
            >
              Pagar com PIX
            </button>
            <button
              onClick={onComplete}
              className="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 w-full"
            >
              Pagar com Cartão
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

