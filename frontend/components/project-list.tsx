'use client';

import { useEffect, useState } from 'react';
import { fetchProjects } from '@/services/api';

type Project = { id: number; code: string; name: string; phase: string; status: string };

export default function ProjectList() {
  const [projects, setProjects] = useState<Project[]>([]);

  useEffect(() => {
    fetchProjects().then((response) => setProjects(response.data ?? []));
  }, []);

  return (
    <div className="rounded-lg border p-4">
      <h2 className="mb-3 text-lg font-semibold">Projects</h2>
      <ul className="space-y-2">
        {projects.map((project) => (
          <li key={project.id} className="rounded bg-slate-50 p-2 text-sm">
            {project.code} - {project.name} ({project.phase}/{project.status})
          </li>
        ))}
      </ul>
    </div>
  );
}
