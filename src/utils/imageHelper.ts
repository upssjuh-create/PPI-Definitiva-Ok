const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';
const BASE_URL = API_BASE_URL.replace('/api', '');

export const getImageUrl = (imagePath: string): string => {
  // Se já é uma URL completa (http/https), retorna como está
  if (imagePath.startsWith('http://') || imagePath.startsWith('https://')) {
    return imagePath;
  }
  
  // Se é um caminho relativo do storage, constrói a URL completa
  if (imagePath.startsWith('events/')) {
    return `${BASE_URL}/storage/${imagePath}`;
  }
  
  // Caso contrário, assume que é um caminho completo do storage
  return `${BASE_URL}/storage/${imagePath}`;
};
