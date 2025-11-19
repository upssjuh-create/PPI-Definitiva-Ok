import React from 'react';

interface LandingProps {
  onGetStarted: () => void;
}

export const Landing: React.FC<LandingProps> = ({ onGetStarted }) => {
  return (
    <div className="min-h-screen bg-gray-50 flex items-center justify-center">
      <div className="text-center">
        <h1 className="text-4xl font-bold mb-4">Bem-vindo ao Sistema de Eventos</h1>
        <p className="text-gray-600 mb-8">Gerencie e participe de eventos acadêmicos</p>
        <button
          onClick={onGetStarted}
          className="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600"
        >
          Começar
        </button>
      </div>
    </div>
  );
};

