import api from './api';


export const eventService = {
async getEvents(filters?: any) {
const response = await api.get('/events', { params: filters });
return response.data;
},


async getEvent(id: number) {
const response = await api.get(`/events/${id}`);
return response.data;
},


async createEvent(eventData: any) {
const response = await api.post('/admin/events', eventData);
return response.data;
},


async updateEvent(id: number, eventData: any) {
const response = await api.put(`/admin/events/${id}`, eventData);
return response.data;
},


async deleteEvent(id: number) {
await api.delete(`/admin/events/${id}`);
},
};