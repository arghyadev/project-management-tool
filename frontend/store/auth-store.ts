import { create } from 'zustand';

type AuthState = {
  token: string | null;
  roleCodes: string[];
  setAuth: (token: string, roleCodes: string[]) => void;
  clearAuth: () => void;
};

export const useAuthStore = create<AuthState>((set) => ({
  token: null,
  roleCodes: [],
  setAuth: (token, roleCodes) => set({ token, roleCodes }),
  clearAuth: () => set({ token: null, roleCodes: [] }),
}));
