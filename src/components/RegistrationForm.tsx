import React from 'react';
import { Event } from '../App';

interface RegistrationFormProps {
  event: Event;
  onBack: () => void;
  onComplete: () => void;
  onLogout: () => void;
}

export const RegistrationForm: React.FC<RegistrationFormProps> = ({
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
          <h2 className="text-2xl font-bold mb-4">Formulário de Inscrição</h2>
          <p className="mb-4">Evento: {event.title}</p>
          <form
            onSubmit={(e) => {
              e.preventDefault();
              onComplete();
            }}
            className="space-y-4"
          >
            <div>
              <label className="block mb-2">Nome Completo</label>
              <input
                type="text"
                className="w-full border rounded-lg px-4 py-2"
                required
              />
            </div>
            <div>
              <label className="block mb-2">Email</label>
              <input
                type="email"
                className="w-full border rounded-lg px-4 py-2"
                required
              />
            </div>
            <div>
              <label className="block mb-2">Matrícula</label>
              <input
                type="text"
                className="w-full border rounded-lg px-4 py-2"
                required
              />
            </div>
            <button
              type="submit"
              className="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 w-full"
            >
              Confirmar Inscrição
            </button>
          </form>
        </div>
      </div>
    </div>
  );
};

