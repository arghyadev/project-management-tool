# Enterprise PMO Tool Architecture (Laravel + Next.js)

## Step 1: System Architecture

### High-Level Architecture
- **Frontend (Next.js App Router + Tailwind + Zustand):** SPA-like UX with role-aware dashboards and module pages.
- **API Backend (Laravel 11):** REST APIs using Controllers → Services → Repositories.
- **Auth:** Laravel Sanctum for SPA auth.
- **Async Processing:** Redis queues + Laravel jobs for heavy automation (MOM/SOW generation).
- **Events:** Domain events (e.g., `MeetingCompletedEvent`) trigger listeners/jobs.
- **Integrations:** Keka API, CRM API, Google/Microsoft Calendar APIs.
- **Database:** PostgreSQL for relational integrity and analytics-friendly queries.
- **Infra:** Dockerized services (nginx/php-fpm, postgres, redis, nextjs), CI/CD pipeline ready.

### Runtime Components
1. Next.js UI calls Laravel REST API via Axios service layer.
2. Laravel authenticates using Sanctum tokens/cookies.
3. Services orchestrate business logic.
4. Repositories encapsulate persistence and query optimization.
5. Events + queued jobs handle non-blocking flows.
6. Audit logs persist all sensitive workflow transitions.

### Meeting Intelligence Automation Flow
1. Calendar webhook/polling detects meeting lifecycle.
2. `MeetingCompletedEvent` dispatched when status=completed.
3. Listener queues `GenerateMomJob` and `GenerateSowJob` (dependent sequencing).
4. AI provider produces MOM + notes.
5. PM approval required before SOW transitions from draft to finalized.
6. MOM/SOW stored in project documents with immutable audit records.

---

## Step 2: Database Design

### Core ERD Explanation
- **users** (id, name, email, password)
- **roles** (id, code, name)
- **user_roles** (user_id, role_id)
- **projects** (id, code, name, client_id, phase, status, start_date, end_date, budget)
- **project_members** (project_id, user_id, allocation_pct, billable)
- **tasks** (id, project_id, parent_task_id, title, status, priority, assignee_id, due_date, estimated_hours)
- **task_comments** (task_id, user_id, comment)
- **timesheets** (user_id, project_id, task_id, work_date, minutes, source)
- **risks** (project_id, owner_id, severity, probability, impact, mitigation_plan, status)
- **issues** (project_id, owner_id, title, status, resolution)
- **financial_snapshots** (project_id, crm_ref, planned_budget, actual_cost, revenue, captured_at)
- **meetings** (project_id, external_meeting_id, title, started_at, ended_at, status, transcript_url)
- **meeting_artifacts** (meeting_id, type[MOM|NOTES|SOW], content, version, approved_by, approved_at)
- **audit_logs** (actor_id, entity_type, entity_id, action, before, after, created_at)

### Indexing/Scalability
- Composite indexes: `(project_id, status)` for tasks, `(user_id, work_date)` for timesheets.
- Unique external refs for integrations (`external_meeting_id`, `crm_ref`, `keka_entry_id`).
- Partition large append-only tables (audit_logs, timesheets) by month/quarter in production.

---

## Step 3: API Design

Base path: `/api/v1`

### Auth & RBAC
- `POST /auth/login`
- `POST /auth/logout`
- `GET /auth/me`
- `GET /roles`

Sample login request:
```json
{ "email": "pm@company.com", "password": "secret123" }
```
Sample response:
```json
{
  "data": {
    "user": {"id": 1, "name": "PM User", "email": "pm@company.com"},
    "roles": ["PM"],
    "token": "1|sanctum-token"
  }
}
```

### Projects
- `GET /projects`
- `POST /projects`
- `GET /projects/{project}`
- `PUT /projects/{project}`
- `DELETE /projects/{project}`

### Tasks
- `GET /projects/{project}/tasks`
- `POST /projects/{project}/tasks`
- `PATCH /tasks/{task}/status`
- `PATCH /tasks/{task}/assign`

### Meeting Automation
- `POST /integrations/calendar/webhook`
- `POST /meetings/{meeting}/approve-mom`
- `POST /meetings/{meeting}/approve-sow`

---

## Step 4: Laravel Folder Structure

```text
backend/
  app/
    Http/
      Controllers/Api/V1/
      Requests/
      Resources/
    Models/
    Policies/
    Services/
    Repositories/
      Contracts/
      Eloquent/
    Events/
    Jobs/
  database/
    migrations/
    seeders/
  routes/
    api.php
```

---

## Step 5: Next.js Folder Structure

```text
frontend/
  app/
    login/
    dashboard/
    projects/
    tasks/
  components/
  services/
  store/
  middleware.ts
```

---

## Step 6: Phase 1 Implementation (Auth + Project + Task)

Phase 1 in this repository includes:
- Laravel API implementation skeleton with real, compile-ready PHP classes:
  - Login/auth API using Sanctum token issuing.
  - Project CRUD using service/repository pattern.
  - Task creation/listing under projects.
  - Policy checks and API resources.
  - Migration for projects and tasks.
- Next.js App Router pages and service-layer API calls:
  - Login page.
  - Dashboard page.
  - Projects page.
  - Tasks page.
  - Zustand auth store and route middleware.

