import React, { useState } from 'react';
import { Landing } from './components/Landing';
import { Auth } from './components/Auth';
import { EventDiscovery } from './components/EventDiscovery';
import { EventDetails } from './components/EventDetails';
import { RegistrationForm } from './components/RegistrationForm';
import { Payment } from './components/Payment';
import { Certificate } from './components/Certificate';
import { MyEvents } from './components/MyEvents';
import { AdminDashboard } from './components/AdminDashboard';
import { EventForm } from './components/EventForm';
import { CompletedEvents } from './components/CompletedEvents';
import { AdminCompletedEventDetails } from './components/AdminCompletedEventDetails';
import { EventQRCode } from './components/EventQRCode';
import { api } from './services/api';

// Sample event data
export interface Student {
  id: number;
  name: string;
  email: string;
  registrationNumber: string;
  course: string;
  semester: number;
  paymentStatus: 'paid' | 'pending' | 'not_paid';
  checkedIn: boolean;
  checkInTime?: string;
  certificateIssued: boolean;
  certificateCode?: string;
}

export interface Cancellation {
  id: number;
  studentId: number;
  studentName: string;
  studentEmail: string;
  registrationNumber: string;
  course: string;
  semester: number;
  eventId: number;
  eventTitle: string;
  cancelledAt: string;
  cancellationReason?: string;
}

export interface Question {
  id: number;
  userId: number;
  userName: string;
  question: string;
  answer?: string;
  answeredBy?: string;
  createdAt: string;
  answeredAt?: string;
}

export interface Event {
  id: number;
  title: string;
  date: string;
  time: string;
  location: string;
  category: string;
  organizer: string;
  capacity: number;
  registered: number;
  price: number;
  image: string;
  description: string;
  speakers: string[];
  tags: string[];
  checkInCode?: string;
  paymentConfig?: {
    acceptsPix: boolean;
    pixKey?: string;
    pixKeyType?: 'cpf' | 'cnpj' | 'email' | 'phone' | 'random';
    pixName?: string;
    acceptsCard: boolean;
    cardAccountName?: string;
    cardAccountBank?: string;
    cardAccountDetails?: string;
  };
  isCompleted?: boolean;
  attendees?: string[];
  students?: Student[];
  questions?: Question[];
  cancellations?: Cancellation[];
}

export const sampleEvents: Event[] = [
  {
    id: 1,
    title: 'Semana Acadêmica de Tecnologia 2025',
    date: '15 de Março de 2025',
    time: '14:00 - 18:00',
    location: 'Auditório Principal',
    category: 'Tecnologia',
    organizer: 'Departamento de TI',
    capacity: 200,
    registered: 145,
    price: 0,
    image: 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800',
    description: 'Uma semana completa de palestras, workshops e networking sobre as mais recentes tendências em tecnologia.',
    speakers: ['Dr. Carlos Mendes - Especialista em IA', 'Prof. Ana Santos - Segurança Cibernética'],
    tags: ['Tecnologia', 'Networking', 'Carreira']
  },
  {
    id: 2,
    title: 'Workshop de Inteligência Artificial',
    date: '10 de Outubro de 2024',
    time: '09:00 - 17:00',
    location: 'Laboratório de Informática - Bloco B',
    category: 'Workshop',
    organizer: 'Coordenação de Ciência da Computação',
    capacity: 30,
    registered: 30,
    price: 50,
    image: 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800',
    description: 'Workshop prático sobre desenvolvimento de aplicações com Machine Learning e Deep Learning. Inclui certificado de 40 horas.',
    speakers: ['Dr. Roberto Machado - PhD em IA pela USP', 'Eng. Marina Costa - Cientista de Dados'],
    tags: ['IA', 'Machine Learning', 'Python'],
    isCompleted: true,
    attendees: ['João Silva', 'Maria Santos', 'Pedro Oliveira'],
    paymentConfig: {
      acceptsPix: true,
      pixKey: 'workshop@iffar.edu.br',
      pixKeyType: 'email',
      pixName: 'IFFar - Campus Panambi',
      acceptsCard: true,
      cardAccountName: 'IFFar - Instituto Federal Farroupilha',
      cardAccountBank: 'Banco do Brasil',
      cardAccountDetails: 'Agência: 1234-5, Conta Corrente: 98765-4'
    },
    students: [
      { id: 1, name: 'João Silva', email: 'joao.silva@aluno.iffar.edu.br', registrationNumber: '2023001', course: 'Ciência da Computação', semester: 5, paymentStatus: 'paid', checkedIn: true, checkInTime: '09:15', certificateIssued: true, certificateCode: 'IFFAR2ABC123' },
      { id: 2, name: 'Maria Santos', email: 'maria.santos@aluno.iffar.edu.br', registrationNumber: '2023002', course: 'Ciência da Computação', semester: 4, paymentStatus: 'paid', checkedIn: true, checkInTime: '09:05', certificateIssued: true, certificateCode: 'IFFAR2DEF456' },
      { id: 3, name: 'Pedro Oliveira', email: 'pedro.oliveira@aluno.iffar.edu.br', registrationNumber: '2023003', course: 'Sistemas de Informação', semester: 6, paymentStatus: 'paid', checkedIn: true, checkInTime: '09:20', certificateIssued: true, certificateCode: 'IFFAR2GHI789' },
      { id: 4, name: 'Ana Costa', email: 'ana.costa@aluno.iffar.edu.br', registrationNumber: '2023004', course: 'Engenharia de Software', semester: 3, paymentStatus: 'paid', checkedIn: false, checkInTime: undefined, certificateIssued: false },
      { id: 5, name: 'Carlos Mendes', email: 'carlos.mendes@aluno.iffar.edu.br', registrationNumber: '2023005', course: 'Ciência da Computação', semester: 5, paymentStatus: 'pending', checkedIn: true, checkInTime: '10:30', certificateIssued: false },
      { id: 6, name: 'Fernanda Lima', email: 'fernanda.lima@aluno.iffar.edu.br', registrationNumber: '2023006', course: 'Sistemas de Informação', semester: 4, paymentStatus: 'paid', checkedIn: true, checkInTime: '09:10', certificateIssued: true, certificateCode: 'IFFAR2JKL012' },
      { id: 7, name: 'Lucas Rodrigues', email: 'lucas.rodrigues@aluno.iffar.edu.br', registrationNumber: '2023007', course: 'Ciência da Computação', semester: 6, paymentStatus: 'not_paid', checkedIn: false, checkInTime: undefined, certificateIssued: false },
      { id: 8, name: 'Juliana Ferreira', email: 'juliana.ferreira@aluno.iffar.edu.br', registrationNumber: '2023008', course: 'Engenharia de Software', semester: 5, paymentStatus: 'paid', checkedIn: true, checkInTime: '09:25', certificateIssued: true, certificateCode: 'IFFAR2MNO345' },
      { id: 9, name: 'Rafael Souza', email: 'rafael.souza@aluno.iffar.edu.br', registrationNumber: '2023009', course: 'Sistemas de Informação', semester: 3, paymentStatus: 'paid', checkedIn: false, checkInTime: undefined, certificateIssued: false },
      { id: 10, name: 'Beatriz Alves', email: 'beatriz.alves@aluno.iffar.edu.br', registrationNumber: '2023010', course: 'Ciência da Computação', semester: 4, paymentStatus: 'paid', checkedIn: true, checkInTime: '09:18', certificateIssued: true, certificateCode: 'IFFAR2PQR678' }
    ],
    questions: [
      {
        id: 1,
        userId: 15,
        userName: 'Ricardo Santos',
        question: 'É necessário ter conhecimento prévio em Python para participar do workshop?',
        answer: 'Olá Ricardo! É recomendado ter conhecimentos básicos de programação, mas não é obrigatório. Teremos uma introdução inicial para nivelar os participantes.',
        answeredBy: 'Admin IFFar',
        createdAt: '01/10/2024 10:30',
        answeredAt: '01/10/2024 14:15'
      },
      {
        id: 2,
        userId: 16,
        userName: 'Paula Mendes',
        question: 'O certificado será válido para horas complementares?',
        answer: 'Sim! O certificado tem validade de 40 horas e pode ser utilizado como horas complementares.',
        answeredBy: 'Admin IFFar',
        createdAt: '02/10/2024 16:20',
        answeredAt: '02/10/2024 17:00'
      },
      {
        id: 3,
        userId: 17,
        userName: 'Marcos Vinícius',
        question: 'Haverá material didático disponibilizado após o evento?',
        createdAt: '09/10/2024 09:45'
      }
    ],
    cancellations: [
      {
        id: 1,
        studentId: 18,
        studentName: 'Gabriel Ferreira',
        studentEmail: 'gabriel.ferreira@aluno.iffar.edu.br',
        registrationNumber: '2023011',
        course: 'Ciência da Computação',
        semester: 5,
        eventId: 1,
        eventTitle: 'Workshop de Inteligência Artificial',
        cancelledAt: '05/10/2024 14:30',
        cancellationReason: 'Conflito de horário com outro compromisso acadêmico.'
      },
      {
        id: 2,
        studentId: 19,
        studentName: 'Fernanda Costa',
        studentEmail: 'fernanda.costa@aluno.iffar.edu.br',
        registrationNumber: '2022089',
        course: 'Análise e Desenvolvimento de Sistemas',
        semester: 3,
        eventId: 1,
        eventTitle: 'Workshop de Inteligência Artificial',
        cancelledAt: '07/10/2024 09:15',
        cancellationReason: 'Questões pessoais impedem minha participação.'
      }
    ]
  },
  {
    id: 3,
    title: 'Palestra: O Futuro da Inteligência Artificial',
    date: '22 de Março de 2025',
    time: '19:00 - 21:00',
    location: 'Auditório Central',
    category: 'Palestra',
    organizer: 'Centro Acadêmico',
    capacity: 150,
    registered: 89,
    price: 15,
    image: 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800',
    description: 'Palestra exclusiva com renomado especialista internacional sobre o futuro da IA e suas aplicações.',
    speakers: ['Dr. John Smith - MIT'],
    tags: ['IA', 'Futuro', 'Tecnologia'],
    paymentConfig: {
      acceptsPix: true,
      pixKey: '12.345.678/0001-90',
      pixKeyType: 'cnpj',
      pixName: 'Instituto Federal Farroupilha',
      acceptsCard: false
    },
    questions: [
      {
        id: 4,
        userId: 20,
        userName: 'Camila Rodrigues',
        question: 'Haverá tradução simultânea durante a palestra? O palestrante falará em inglês?',
        createdAt: '15/03/2025 10:20'
      },
      {
        id: 5,
        userId: 21,
        userName: 'Diego Martins',
        question: 'Quais são os principais tópicos que serão abordados na palestra?',
        createdAt: '16/03/2025 14:45'
      }
    ]
  },
  {
    id: 4,
    title: 'Minicurso de Desenvolvimento Web',
    date: '05 de Abril de 2025',
    time: '08:00 - 12:00',
    location: 'Sala 201 - Bloco A',
    category: 'Minicurso',
    organizer: 'Departamento de TI',
    capacity: 40,
    registered: 35,
    price: 25,
    image: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800',
    description: 'Aprenda a desenvolver aplicações web modernas com React, Node.js e banco de dados.',
    speakers: ['Prof. Lucas Ferreira', 'Dev. Amanda Silva'],
    tags: ['Web', 'React', 'Node.js'],
    paymentConfig: {
      acceptsPix: true,
      pixKey: '(55) 99999-8888',
      pixKeyType: 'phone',
      pixName: 'IFFar Campus',
      acceptsCard: true,
      cardAccountName: 'IFFar',
      cardAccountBank: 'PagSeguro',
      cardAccountDetails: 'Gateway de pagamento online via PagSeguro'
    },
    questions: [
      {
        id: 6,
        userId: 22,
        userName: 'Thiago Almeida',
        question: 'Preciso levar notebook próprio ou haverá computadores disponíveis?',
        createdAt: '28/03/2025 11:15'
      },
      {
        id: 7,
        userId: 23,
        userName: 'Larissa Souza',
        question: 'Ao final do curso, teremos um projeto prático para portfólio?',
        createdAt: '30/03/2025 16:50'
      }
    ],
    cancellations: [
      {
        id: 3,
        studentId: 24,
        studentName: 'Rodrigo Andrade',
        studentEmail: 'rodrigo.andrade@aluno.iffar.edu.br',
        registrationNumber: '2023025',
        course: 'Sistemas de Informação',
        semester: 4,
        eventId: 4,
        eventTitle: 'Minicurso de Desenvolvimento Web',
        cancelledAt: '01/04/2025 08:20',
        cancellationReason: 'Viagem inesperada marcada para a mesma data.'
      }
    ]
  },
  {
    id: 5,
    title: 'Semana Acadêmica de Agronomia 2024',
    date: '15 de Setembro de 2024',
    time: '08:00 - 18:00',
    location: 'Campus IFFar - Área Rural',
    category: 'Semana Acadêmica',
    organizer: 'Departamento de Agronomia',
    capacity: 180,
    registered: 180,
    price: 0,
    image: 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=800',
    description: 'Evento completo com palestras, visitas técnicas e workshops sobre agricultura sustentável, tecnologias no campo e inovação agrícola.',
    speakers: ['Prof. Dr. Antonio Cardoso - Agronomia Sustentável', 'Eng. Agr. Beatriz Lima - Tecnologia no Campo', 'Dr. Fernando Santos - Solos e Fertilidade'],
    tags: ['Agronomia', 'Agricultura', 'Sustentabilidade'],
    isCompleted: true,
    attendees: ['João Silva', 'Carlos Alberto', 'Fernanda Costa']
  },
  {
    id: 6,
    title: 'Curso de Python para Análise de Dados',
    date: '20 de Agosto de 2024',
    time: '14:00 - 18:00',
    location: 'Laboratório de Informática 3',
    category: 'Minicurso',
    organizer: 'Departamento de Ciência da Computação',
    capacity: 25,
    registered: 25,
    price: 30,
    image: 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=800',
    description: 'Minicurso prático de Python focado em análise de dados com Pandas, NumPy e visualização com Matplotlib.',
    speakers: ['Prof. Ricardo Alves - Cientista de Dados', 'MSc. Paula Mendes - Estatística Aplicada'],
    tags: ['Python', 'Dados', 'Programação'],
    isCompleted: true,
    attendees: ['João Silva', 'Ana Paula', 'José Roberto'],
    paymentConfig: {
      acceptsPix: true,
      pixKey: 'python.curso@iffar.edu.br',
      pixKeyType: 'email',
      pixName: 'IFFar - Departamento CC',
      acceptsCard: false
    }
  },
  {
    id: 7,
    title: 'Palestra: Empreendedorismo e Inovação',
    date: '05 de Julho de 2024',
    time: '19:30 - 21:30',
    location: 'Auditório Principal',
    category: 'Palestra',
    organizer: 'Coordenação de Extensão',
    capacity: 200,
    registered: 175,
    price: 0,
    image: 'https://images.unsplash.com/photo-1556761175-b413da4baf72?w=800',
    description: 'Palestra inspiradora sobre empreendedorismo, inovação tecnológica e cases de sucesso de ex-alunos do IFFar.',
    speakers: ['Empresário João Marcelo - CEO TechStart', 'Profª Dra. Silvia Andrade - Inovação'],
    tags: ['Empreendedorismo', 'Inovação', 'Carreira'],
    isCompleted: true,
    attendees: ['João Silva', 'Marcos Vinícius', 'Laura Souza']
  }
];

export default function App() {
  const [showLanding, setShowLanding] = useState(true);
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [userType, setUserType] = useState<'student' | 'admin'>('student');
  const [currentScreen, setCurrentScreen] = useState<'discovery' | 'details' | 'registration' | 'payment' | 'certificate' | 'myevents' | 'admindashboard' | 'eventform' | 'completedevents' | 'admincompletedevent' | 'eventqrcode'>('discovery');
  const [selectedEvent, setSelectedEvent] = useState<Event | null>(null);
  const [events, setEvents] = useState<Event[]>(sampleEvents);

  const handleGetStarted = () => {
    setShowLanding(false);
  };

  const handleLogin = (type: 'student' | 'admin') => {
    setIsAuthenticated(true);
    setUserType(type);
    // Admin vai direto para dashboard
    if (type === 'admin') {
      setCurrentScreen('admindashboard');
    }
  };

  const handleLogout = () => {
    setIsAuthenticated(false);
    setUserType('student');
    setCurrentScreen('discovery');
    setSelectedEvent(null);
  };

  const handleEventSelect = (event: Event) => {
    setSelectedEvent(event);
    setCurrentScreen('details');
  };

  const handleRegisterClick = () => {
    setCurrentScreen('registration');
  };

  const handleBackToDiscovery = () => {
    setCurrentScreen('discovery');
    setSelectedEvent(null);
  };

  const handleBackToDetails = () => {
    setCurrentScreen('details');
  };

  const handleRegistrationComplete = () => {
    // Se o evento é pago, vai para pagamento, senão pula direto para discovery
    if (selectedEvent && selectedEvent.price > 0) {
      setCurrentScreen('payment');
    } else {
      handleBackToDiscovery();
    }
  };

  const handlePaymentComplete = () => {
    // Após pagamento bem sucedido, volta para discovery
    handleBackToDiscovery();
  };

  const handlePayment = () => {
    setCurrentScreen('payment');
  };

  const handleCertificate = () => {
    setCurrentScreen('certificate');
  };

  const handleMyEvents = () => {
    setCurrentScreen('myevents');
  };

  const handleCompletedEvents = () => {
    setCurrentScreen('completedevents');
  };

  const handleAdminDashboard = () => {
    setCurrentScreen('admindashboard');
  };

  const handleCreateEvent = () => {
    setSelectedEvent(null);
    setCurrentScreen('eventform');
  };

  const handleEditEvent = (event: Event) => {
    setSelectedEvent(event);
    setCurrentScreen('eventform');
  };

  const handleDeleteEvent = (eventId: number) => {
    setEvents((prev: Event[]) => prev.filter((e: Event) => e.id !== eventId));
  };

  const handleSaveEvent = async (eventData: Partial<Event>) => {
    try {
      if (selectedEvent) {
        // Editing existing event
        const updatedEvent = await api.updateEvent(selectedEvent.id, eventData);
        setEvents((prev: Event[]) => prev.map((e: Event) => 
          e.id === selectedEvent.id 
            ? { ...e, ...updatedEvent } as Event
            : e
        ));
      } else {
        // Creating new event
        const newEvent = await api.createEvent(eventData);
        setEvents((prev: Event[]) => [...prev, newEvent]);
      }
      setCurrentScreen('admindashboard');
    } catch (error) {
      console.error('Erro ao salvar evento:', error);
      alert('Erro ao salvar evento. Por favor, tente novamente.');
    }
  };

  const handleViewCompletedEvent = (event: Event) => {
    setSelectedEvent(event);
    setCurrentScreen('admincompletedevent');
  };

  const handleGenerateQRCode = (event: Event) => {
    setSelectedEvent(event);
    setCurrentScreen('eventqrcode');
  };

  // Show landing page first
  if (showLanding) {
    return <Landing onGetStarted={handleGetStarted} />;
  }

  // Show auth screen if not authenticated
  if (!isAuthenticated) {
    return <Auth onLogin={handleLogin} />;
  }

  return (
    <div className="min-h-screen bg-gray-50">
      {currentScreen === 'discovery' && (
        <EventDiscovery 
          events={sampleEvents} 
          onEventSelect={handleEventSelect} 
          onLogout={handleLogout}
          onMyEvents={handleMyEvents}
          onAdminDashboard={handleAdminDashboard}
          onCompletedEvents={handleCompletedEvents}
        />
      )}
      
      {currentScreen === 'details' && selectedEvent && (
        <EventDetails 
          event={selectedEvent} 
          onBack={handleBackToDiscovery}
          onRegister={handleRegisterClick}
          onLogout={handleLogout}
          userType={userType}
        />
      )}
      
      {currentScreen === 'registration' && selectedEvent && (
        <RegistrationForm 
          event={selectedEvent}
          onBack={handleBackToDetails}
          onComplete={handleRegistrationComplete}
          onLogout={handleLogout}
        />
      )}
      
      {currentScreen === 'payment' && selectedEvent && (
        <Payment 
          event={selectedEvent}
          onBack={handleBackToDetails}
          onComplete={handlePaymentComplete}
          onLogout={handleLogout}
        />
      )}
      
      {currentScreen === 'certificate' && selectedEvent && (
        <Certificate 
          event={selectedEvent}
          onBack={handleBackToDetails}
          onLogout={handleLogout}
        />
      )}
      
      {currentScreen === 'myevents' && (
        <MyEvents 
          events={sampleEvents}
          onLogout={handleLogout}
          onViewCertificate={(event: Event) => {
            setSelectedEvent(event);
            setCurrentScreen('certificate');
          }}
          onBackToEvents={handleBackToDiscovery}
        />
      )}
      
      {currentScreen === 'admindashboard' && (
        <AdminDashboard 
          events={events}
          onLogout={handleLogout}
          onCreateEvent={handleCreateEvent}
          onEditEvent={handleEditEvent}
          onDeleteEvent={handleDeleteEvent}
          onViewCompletedEvent={handleViewCompletedEvent}
          onGenerateQRCode={handleGenerateQRCode}
        />
      )}
      
      {currentScreen === 'eventform' && (
        <EventForm 
          event={selectedEvent}
          onBack={handleAdminDashboard}
          onSave={handleSaveEvent}
          onLogout={handleLogout}
        />
      )}
      
      {currentScreen === 'completedevents' && (
        <CompletedEvents 
          events={sampleEvents}
          onLogout={handleLogout}
          onViewCertificate={(event: Event) => {
            setSelectedEvent(event);
            setCurrentScreen('certificate');
          }}
          onBackToEvents={handleBackToDiscovery}
        />
      )}
      
      {currentScreen === 'admincompletedevent' && selectedEvent && (
        <AdminCompletedEventDetails 
          event={selectedEvent}
          onBack={handleAdminDashboard}
          onLogout={handleLogout}
        />
      )}
      
      {currentScreen === 'eventqrcode' && selectedEvent && (
        <EventQRCode 
          event={selectedEvent}
          onBack={handleAdminDashboard}
          onLogout={handleLogout}
        />
      )}
    </div>
  );
}