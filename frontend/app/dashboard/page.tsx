import AppShell from '@/components/app-shell';
import ProjectList from '@/components/project-list';

export default function DashboardPage() {
  return (
    <AppShell>
      <main className="space-y-6 p-6">
        <h1 className="text-3xl font-bold">PMO Dashboard</h1>
        <ProjectList />
      </main>
    </AppShell>
  );
}
