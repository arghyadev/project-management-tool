import AppShell from '@/components/app-shell';
import TimesheetLedger from '@/components/timesheet-ledger';

export default function TimesheetsPage() {
  return (
    <AppShell>
      <main className="space-y-6 p-6">
        <h1 className="text-2xl font-bold">Phase 2 — Timesheets</h1>
        <TimesheetLedger />
      </main>
    </AppShell>
  );
}
