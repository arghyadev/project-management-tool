import Link from 'next/link';

export default function HomePage() {
  return (
    <main className="mx-auto mt-20 max-w-2xl rounded border bg-white p-8">
      <h1 className="text-3xl font-bold">Enterprise PMO Tool</h1>
      <p className="mt-3 text-slate-600">Start by signing in to access projects, tasks, and dashboards.</p>
      <Link className="mt-6 inline-block rounded bg-blue-600 px-4 py-2 text-white" href="/login">
        Go to Login
      </Link>
    </main>
  );
}
