import api from './api';


export const registrationService = {
async register(eventId: number) {
const response = await api.post(`/events/${eventId}/register`);
return response.data;
},


async getMyRegistrations() {
const response = await api.get('/my-registrations');
return response.data;
},


async checkIn(checkInCode: string) {
const response = await api.post('/check-in', { check_in_code: checkInCode });
return response.data;
},
};