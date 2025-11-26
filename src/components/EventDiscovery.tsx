import React from 'react';
import { Event } from '../App';
import { getImageUrl } from '../utils/imageHelper';

interface EventDiscoveryProps {
  events: Event[];
  onEventSelect: (event: Event) => void;
  onLogout: () => void;
  onMyEvents: () => void;
  onAdminDashboard: () => void;
  onCompletedEvents: () => void;
}

export const EventDiscovery: React.FC<EventDiscoveryProps> = ({
  events,
  onEventSelect,
  onLogout,
  onMyEvents,
  onAdminDashboard,
  onCompletedEvents,
}) => {
  return (
    <div className="min-h-screen bg-gray-50 p-6">
      <div className="max-w-7xl mx-auto">
        <div className="flex justify-between items-center mb-6">
          <h1 className="text-3xl font-bold">Descobrir Eventos</h1>
          <div className="space-x-4">
            <button
              onClick={onMyEvents}
              className="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
            >
              Meus Eventos
            </button>
            <button
              onClick={onAdminDashboard}
              className="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600"
            >
              Admin
            </button>
            <button
              onClick={onCompletedEvents}
              className="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600"
            >
              Eventos Concluídos
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
              onClick={() => onEventSelect(event)}
              className="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer hover:shadow-lg transition-shadow"
            >
              <img
                src={getImageUrl(event.image)}
                alt={event.title}
                className="w-full h-48 object-cover"
              />
              <div className="p-4">
                <h3 className="text-xl font-bold mb-2">{event.title}</h3>
                <p className="text-gray-600 text-sm mb-2">{event.date}</p>
                <p className="text-gray-600 text-sm">{event.location}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

