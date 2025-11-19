import React from 'react';
import { Event } from '../App';

interface AdminCompletedEventDetailsProps {
  event: Event;
  onBack: () => void;
  onLogout: () => void;
}

export const AdminCompletedEventDetails: React.FC<AdminCompletedEventDetailsProps> = ({
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
              <strong>Inscritos:</strong> {event.registered} / {event.capacity}
            </div>
          </div>
          {event.students && event.students.length > 0 && (
            <div className="mt-6">
              <h2 className="text-2xl font-bold mb-4">Participantes</h2>
              <div className="overflow-x-auto">
                <table className="w-full border-collapse border border-gray-300">
                  <thead>
                    <tr className="bg-gray-100">
                      <th className="border border-gray-300 px-4 py-2">Nome</th>
                      <th className="border border-gray-300 px-4 py-2">Matrícula</th>
                      <th className="border border-gray-300 px-4 py-2">Status Pagamento</th>
                      <th className="border border-gray-300 px-4 py-2">Check-in</th>
                      <th className="border border-gray-300 px-4 py-2">Certificado</th>
                    </tr>
                  </thead>
                  <tbody>
                    {event.students.map((student) => (
                      <tr key={student.id}>
                        <td className="border border-gray-300 px-4 py-2">{student.name}</td>
                        <td className="border border-gray-300 px-4 py-2">{student.registrationNumber}</td>
                        <td className="border border-gray-300 px-4 py-2">{student.paymentStatus}</td>
                        <td className="border border-gray-300 px-4 py-2">
                          {student.checkedIn ? 'Sim' : 'Não'}
                        </td>
                        <td className="border border-gray-300 px-4 py-2">
                          {student.certificateIssued ? 'Sim' : 'Não'}
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

