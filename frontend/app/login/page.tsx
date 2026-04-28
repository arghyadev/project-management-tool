'use client';

import { FormEvent, useState } from 'react';
import { useRouter } from 'next/navigation';
import { login } from '@/services/api';
import { useAuthStore } from '@/store/auth-store';

export default function LoginPage() {
  const router = useRouter();
  const { setAuth } = useAuthStore();
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const onSubmit = async (event: FormEvent) => {
    event.preventDefault();
    const response = await login({ email, password });
    setAuth(response.data.token, response.data.roles ?? []);
    router.push('/dashboard');
  };

  return (
    <main className="mx-auto mt-20 max-w-md rounded border p-6">
      <h1 className="mb-4 text-2xl font-bold">PMO Login</h1>
      <form onSubmit={onSubmit} className="space-y-3">
        <input className="w-full rounded border p-2" placeholder="Email" value={email} onChange={(e) => setEmail(e.target.value)} />
        <input className="w-full rounded border p-2" placeholder="Password" type="password" value={password} onChange={(e) => setPassword(e.target.value)} />
        <button className="w-full rounded bg-blue-600 p-2 text-white" type="submit">Sign in</button>
      </form>
    </main>
  );
}
