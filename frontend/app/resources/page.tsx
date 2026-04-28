import AppShell from '@/components/app-shell';
import ResourceAllocationBoard from '@/components/resource-allocation-board';

export default function ResourcesPage() {
  return (
    <AppShell>
      <main className="space-y-6 p-6">
        <h1 className="text-2xl font-bold">Phase 2 — Resource Allocation</h1>
        <ResourceAllocationBoard />
      </main>
    </AppShell>
  );
}
