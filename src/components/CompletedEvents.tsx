import React from 'react';
import { Event } from '../App';
import { getImageUrl } from '../utils/imageHelper';

interface CompletedEventsProps {
  events: Event[];
  onLogout: () => void;
  onViewCertificate: (event: Event) => void;
  onBackToEvents: () => void;
}

export const CompletedEvents: React.FC<CompletedEventsProps> = ({
  events,
  onLogout,
  onViewCertificate,
  onBackToEvents,
}) => {
  const completedEvents = events.filter((e) => e.isCompleted);

  return (
    <div className="min-h-screen bg-gray-50 p-6">
      <div className="max-w-7xl mx-auto">
        <div className="flex justify-between items-center mb-6">
          <h1 className="text-3xl font-bold">Eventos Concluídos</h1>
          <div className="space-x-4">
            <button
              onClick={onBackToEvents}
              className="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
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
        </div>
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {completedEvents.map((event) => (
            <div
              key={event.id}
              className="bg-white rounded-lg shadow-md overflow-hidden"
            >
              <img
                src={getImageUrl(event.image)}
                alt={event.title}
                className="w-full h-48 object-cover"
              />
              <div className="p-4">
                <h3 className="text-xl font-bold mb-2">{event.title}</h3>
                <p className="text-gray-600 text-sm mb-4">{event.date}</p>
                <button
                  onClick={() => onViewCertificate(event)}
                  className="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 w-full"
                >
                  Ver Certificado
                </button>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

