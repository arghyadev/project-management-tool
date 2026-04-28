'use client';

import { useEffect, useState } from 'react';
import { fetchProjectMembers, upsertProjectMember } from '@/services/api';

type Member = { id: number; user_id: number; allocation_pct: number; billable: boolean };

export default function ResourceAllocationBoard() {
  const [members, setMembers] = useState<Member[]>([]);

  const load = async () => {
    const response = await fetchProjectMembers(1);
    setMembers(response.data.members ?? []);
  };

  useEffect(() => {
    load();
  }, []);

  const addDemoMember = async () => {
    await upsertProjectMember(1, { user_id: 1, allocation_pct: 60, billable: true });
    await load();
  };

  return (
    <div className="rounded border bg-white p-4">
      <div className="mb-3 flex items-center justify-between">
        <h2 className="text-lg font-semibold">Resource Allocation</h2>
        <button onClick={addDemoMember} className="rounded bg-blue-600 px-3 py-1 text-sm text-white">Add/Update Demo Member</button>
      </div>
      <ul className="space-y-2 text-sm">
        {members.map((member) => (
          <li key={member.id} className="rounded bg-slate-50 p-2">
            User #{member.user_id} — {member.allocation_pct}% — {member.billable ? 'Billable' : 'Non-billable'}
          </li>
        ))}
      </ul>
    </div>
  );
}
