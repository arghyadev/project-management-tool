import AppShell from '@/components/app-shell';
import FinancialOverview from '@/components/financial-overview';

export default function FinancialsPage() {
  return (
    <AppShell>
      <main className="space-y-6 p-6">
        <h1 className="text-2xl font-bold">Phase 3 — CRM & Financials</h1>
        <FinancialOverview />
      </main>
    </AppShell>
  );
}
