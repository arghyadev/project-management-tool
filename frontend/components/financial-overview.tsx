'use client';

import { useEffect, useState } from 'react';
import { fetchFinancials, syncFinancials } from '@/services/api';

type Financial = {
  id: number;
  planned_budget: number;
  actual_cost: number;
  revenue: number;
  captured_at: string;
};

export default function FinancialOverview() {
  const [rows, setRows] = useState<Financial[]>([]);

  const load = async () => {
    const response = await fetchFinancials(1);
    setRows(response.data.financials ?? []);
  };

  useEffect(() => {
    load();
  }, []);

  const onSync = async () => {
    await syncFinancials(1, { external_project_code: 'PMO-001' });
    await load();
  };

  return (
    <div className="rounded border bg-white p-4">
      <div className="mb-3 flex items-center justify-between">
        <h2 className="text-lg font-semibold">Financial Snapshots</h2>
        <button onClick={onSync} className="rounded bg-violet-600 px-3 py-1 text-sm text-white">Sync from CRM</button>
      </div>
      <ul className="space-y-2 text-sm">
        {rows.map((row) => (
          <li key={row.id} className="rounded bg-slate-50 p-2">
            Planned: {row.planned_budget} | Actual: {row.actual_cost} | Revenue: {row.revenue} | Captured: {row.captured_at}
          </li>
        ))}
      </ul>
    </div>
  );
}
