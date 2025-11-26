import React from 'react';
import { Event } from '../App';
import { getImageUrl } from '../utils/imageHelper';

interface AdminDashboardProps {
  events: Event[];
  onLogout: () => void;
  onCreateEvent: () => void;
  onEditEvent: (event: Event) => void;
  onDeleteEvent: (eventId: number) => void;
  onViewCompletedEvent: (event: Event) => void;
}

export const AdminDashboard: React.FC<AdminDashboardProps> = ({
  events,
  onLogout,
  onCreateEvent,
  onEditEvent,
  onDeleteEvent,
  onViewCompletedEvent,
}) => {
  return (
    <div className="min-h-screen bg-gray-50 p-6">
      <div className="max-w-7xl mx-auto">
        <div className="flex justify-between items-center mb-6">
          <h1 className="text-3xl font-bold">Painel Administrativo</h1>
          <div className="space-x-4">
            <button
              onClick={onCreateEvent}
              className="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600"
            >
              Criar Evento
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
          {events.map((event) => (
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
                <div className="space-y-2">
                  <button
                    onClick={() => onEditEvent(event)}
                    className="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 w-full"
                  >
                    Editar
                  </button>
                  {event.isCompleted && (
                    <button
                      onClick={() => onViewCompletedEvent(event)}
                      className="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 w-full"
                    >
                      Ver Detalhes
                    </button>
                  )}
                  <button
                    onClick={() => onDeleteEvent(event.id)}
                    className="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 w-full"
                  >
                    Excluir
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

