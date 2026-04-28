'use client';

import { useEffect, useState } from 'react';
import { fetchTimesheets, syncTimesheets } from '@/services/api';

type Timesheet = { id: number; user_id: number; project_id: number; work_date: string; minutes: number; source: string };

export default function TimesheetLedger() {
  const [rows, setRows] = useState<Timesheet[]>([]);

  const load = async () => {
    const response = await fetchTimesheets();
    setRows(response.data.timesheets ?? []);
  };

  useEffect(() => {
    load();
  }, []);

  const onSync = async () => {
    await syncTimesheets({ from_date: '2026-04-01', to_date: '2026-04-30' });
    await load();
  };

  return (
    <div className="rounded border bg-white p-4">
      <div className="mb-3 flex items-center justify-between">
        <h2 className="text-lg font-semibold">Timesheet Ledger</h2>
        <button onClick={onSync} className="rounded bg-emerald-600 px-3 py-1 text-sm text-white">Sync from Keka</button>
      </div>
      <ul className="space-y-2 text-sm">
        {rows.map((row) => (
          <li key={row.id} className="rounded bg-slate-50 p-2">
            {row.work_date} — User #{row.user_id} — Project #{row.project_id} — {row.minutes} mins ({row.source})
          </li>
        ))}
      </ul>
    </div>
  );
}
