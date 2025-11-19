import React from 'react';

interface AuthProps {
  onLogin: (type: 'student' | 'admin') => void;
}

export const Auth: React.FC<AuthProps> = ({ onLogin }) => {
  return (
    <div className="min-h-screen bg-gray-50 flex items-center justify-center">
      <div className="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 className="text-2xl font-bold mb-6 text-center">Login</h2>
        <div className="space-y-4">
          <button
            onClick={() => onLogin('student')}
            className="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
          >
            Entrar como Aluno
          </button>
          <button
            onClick={() => onLogin('admin')}
            className="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600"
          >
            Entrar como Admin
          </button>
        </div>
      </div>
    </div>
  );
};

