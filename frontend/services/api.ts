import axios from 'axios';

export const api = axios.create({
  baseURL: process.env.NEXT_PUBLIC_API_BASE_URL ?? 'http://localhost:8000/api/v1',
  withCredentials: true,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
});

export type LoginPayload = { email: string; password: string };

export async function login(payload: LoginPayload) {
  const { data } = await api.post('/auth/login', payload);
  return data;
}

export async function fetchProjects() {
  const { data } = await api.get('/projects');
  return data;
}

export async function fetchProjectTasks(projectId: number) {
  const { data } = await api.get(`/projects/${projectId}/tasks`);
  return data;
}
