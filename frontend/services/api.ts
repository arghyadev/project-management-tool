import axios from 'axios';

export const api = axios.create({
  baseURL: process.env.NEXT_PUBLIC_API_BASE_URL ?? 'http://localhost:8000/api/v1',
  withCredentials: true,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
  },
});

api.interceptors.request.use((config) => {
  if (typeof window !== 'undefined') {
    const storage = localStorage.getItem('pmo-auth-store');
    const parsed = storage ? JSON.parse(storage) : null;
    const token = parsed?.state?.token;
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
  }
  return config;
});

api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (typeof window !== 'undefined' && [401, 419].includes(error?.response?.status)) {
      localStorage.removeItem('pmo-auth-store');
      document.cookie = 'pmo_token=; Max-Age=0; path=/';
      window.location.href = '/login';
    }
    return Promise.reject(error);
  },
);

export type LoginPayload = { email: string; password: string };
export type SyncTimesheetPayload = { from_date: string; to_date: string; source?: 'keka' | 'manual' };
export type ProjectMemberPayload = { user_id: number; allocation_pct: number; billable: boolean };

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

export async function fetchProjectMembers(projectId: number) {
  const { data } = await api.get(`/projects/${projectId}/members`);
  return data;
}

export async function upsertProjectMember(projectId: number, payload: ProjectMemberPayload) {
  const { data } = await api.post(`/projects/${projectId}/members`, payload);
  return data;
}

export async function fetchTimesheets() {
  const { data } = await api.get('/timesheets');
  return data;
}

export async function syncTimesheets(payload: SyncTimesheetPayload) {
  const { data } = await api.post('/timesheets/sync', payload);
  return data;
}
