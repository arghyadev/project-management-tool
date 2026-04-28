'use client';

import AppShell from '@/components/app-shell';
import { useEffect, useState } from 'react';
import { fetchProjectTasks } from '@/services/api';

type Task = { id: number; title: string; status: string; priority: string };

export default function TasksPage() {
  const [tasks, setTasks] = useState<Task[]>([]);

  useEffect(() => {
    fetchProjectTasks(1).then((response) => setTasks(response.data ?? []));
  }, []);

  return (
    <AppShell>
      <main className="p-6">
        <h1 className="mb-4 text-2xl font-bold">Tasks</h1>
        <div className="grid gap-3 md:grid-cols-2">
          {tasks.map((task) => (
            <div key={task.id} className="rounded border p-3">
              <p className="font-semibold">{task.title}</p>
              <p className="text-sm text-slate-600">{task.status} / {task.priority}</p>
            </div>
          ))}
        </div>
      </main>
    </AppShell>
  );
}
