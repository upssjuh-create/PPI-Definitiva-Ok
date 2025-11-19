import api from './api';


export const authService = {
async login(email: string, password: string) {
const response = await api.post('/login', { email, password });
localStorage.setItem('auth_token', response.data.access_token);
return response.data;
},


async register(userData: any) {
const response = await api.post('/register', userData);
localStorage.setItem('auth_token', response.data.access_token);
return response.data;
},


async logout() {
await api.post('/logout');
localStorage.removeItem('auth_token');
},


async me() {
const response = await api.get('/me');
return response.data;
},
};