const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';

export const api = {
  async createEvent(eventData: any) {
    const formData = new FormData();
    
    // Adicionar todos os campos do evento
    Object.keys(eventData).forEach(key => {
      if (key === 'imageFile' && eventData[key]) {
        formData.append('image', eventData[key]);
      } else if (key !== 'imageFile' && eventData[key] !== undefined && eventData[key] !== null) {
        if (Array.isArray(eventData[key])) {
          formData.append(key, JSON.stringify(eventData[key]));
        } else {
          formData.append(key, eventData[key].toString());
        }
      }
    });

    const token = localStorage.getItem('auth_token');
    const response = await fetch(`${API_BASE_URL}/admin/events`, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`,
      },
      body: formData,
    });

    if (!response.ok) {
      throw new Error('Erro ao criar evento');
    }

    return response.json();
  },

  async updateEvent(eventId: number, eventData: any) {
    const formData = new FormData();
    
    // Laravel precisa do _method para simular PUT com FormData
    formData.append('_method', 'PUT');
    
    // Adicionar todos os campos do evento
    Object.keys(eventData).forEach(key => {
      if (key === 'imageFile' && eventData[key]) {
        formData.append('image', eventData[key]);
      } else if (key !== 'imageFile' && eventData[key] !== undefined && eventData[key] !== null) {
        if (Array.isArray(eventData[key])) {
          formData.append(key, JSON.stringify(eventData[key]));
        } else {
          formData.append(key, eventData[key].toString());
        }
      }
    });

    const token = localStorage.getItem('auth_token');
    const response = await fetch(`${API_BASE_URL}/admin/events/${eventId}`, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`,
      },
      body: formData,
    });

    if (!response.ok) {
      throw new Error('Erro ao atualizar evento');
    }

    return response.json();
  },
};
