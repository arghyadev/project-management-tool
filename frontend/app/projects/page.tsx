import AppShell from '@/components/app-shell';
import ProjectList from '@/components/project-list';

export default function ProjectsPage() {
  return (
    <AppShell>
      <main className="p-6">
        <ProjectList />
      </main>
    </AppShell>
  );
}
