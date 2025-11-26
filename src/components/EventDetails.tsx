import React from 'react';
import { Event } from '../App';
import { getImageUrl } from '../utils/imageHelper';

interface EventDetailsProps {
  event: Event;
  onBack: () => void;
  onRegister: () => void;
  onLogout: () => void;
  userType: 'student' | 'admin';
}

export const EventDetails: React.FC<EventDetailsProps> = ({
  event,
  onBack,
  onRegister,
  onLogout,
  userType,
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
        <div className="bg-white rounded-lg shadow-md overflow-hidden">
          <img
            src={getImageUrl(event.image)}
            alt={event.title}
            className="w-full h-64 object-cover"
          />
          <div className="p-6">
            <h1 className="text-3xl font-bold mb-4">{event.title}</h1>
            <p className="text-gray-600 mb-4">{event.description}</p>
            <div className="grid grid-cols-2 gap-4 mb-4">
              <div>
                <strong>Data:</strong> {event.date}
              </div>
              <div>
                <strong>Horário:</strong> {event.time}
              </div>
              <div>
                <strong>Local:</strong> {event.location}
              </div>
              <div>
                <strong>Preço:</strong> R$ {event.price.toFixed(2)}
              </div>
            </div>
            {userType === 'student' && (
              <button
                onClick={onRegister}
                className="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600"
              >
                Inscrever-se
              </button>
            )}
          </div>
        </div>
      </div>
    </div>
  );
};

