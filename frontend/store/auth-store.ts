import { create } from 'zustand';
import { persist } from 'zustand/middleware';

type AuthState = {
  token: string | null;
  roleCodes: string[];
  setAuth: (token: string, roleCodes: string[]) => void;
  clearAuth: () => void;
};

export const useAuthStore = create<AuthState>()(
  persist(
    (set) => ({
      token: null,
      roleCodes: [],
      setAuth: (token, roleCodes) => set({ token, roleCodes }),
      clearAuth: () => set({ token: null, roleCodes: [] }),
    }),
    {
      name: 'pmo-auth-store',
    },
  ),
);
