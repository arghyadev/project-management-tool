# PMO Platform Implementation Roadmap (Step-by-Step)

This document turns the current scaffold into a complete enterprise PMO implementation plan, with backend, frontend, DB, integration, and delivery checkpoints.

## Current Status (Completed)
- Monorepo scaffold is in place (`backend`, `frontend`, `docs`, `docker-compose`).
- Phase 1 baseline implemented:
  - Auth APIs (Sanctum), project CRUD, task listing/creation.
  - Controller → Service → Repository structure.
  - Basic Next.js App Router pages and service layer.

## Step 1 — Harden Foundation (1 sprint)
### Backend
- Add centralized exception mapping (`app/Exceptions/Handler.php`) for consistent API error envelopes.
- Add API version contract tests for auth/projects/tasks.
- Register policies and repository provider in bootstrap providers list.

### Frontend
- Add auth token persistence and Axios interceptor for 401/419 handling.
- Add shared layout shell with role-aware navigation.

### Database
- Add users/roles/user_roles if not yet present in base schema.

### Exit Criteria
- CI runs lint + tests for backend/frontend.
- Login/logout/session renewal works end-to-end.

## Step 2 — Resource & Timesheet (Phase 2)
### Backend
- Resource allocation endpoints:
  - `GET /projects/{project}/members`
  - `POST /projects/{project}/members`
  - `PATCH /project-members/{member}`
- Timesheet ingestion endpoints:
  - `POST /integrations/keka/sync`
  - `GET /timesheets?user_id=&project_id=&date_from=&date_to=`

### Frontend
- Resource allocation board (project utilization heatmap).
- Timesheet ledger + weekly view.

### Database
- `project_members`, `timesheets`.

### Exit Criteria
- Utilization report accuracy validated against sample Keka payload.

## Step 3 — CRM + Financials (Phase 3)
### Backend
- CRM sync jobs and `financial_snapshots` history.
- Endpoints:
  - `POST /integrations/crm/sync`
  - `GET /projects/{project}/financials`

### Frontend
- Budget vs actual dashboard.
- Revenue forecast widgets.

### Database
- `financial_snapshots` with immutable capture timestamps.

### Exit Criteria
- Daily financial snapshot sync with retry + audit trail.

## Step 4 — Risk + Reporting (Phase 4)
### Backend
- Risks/issues CRUD and status transitions.
- Reporting APIs for KPI cards and trend charts.

### Frontend
- Risk register with severity/probability matrix.
- Executive dashboard.

### Database
- `risks`, `issues`, `audit_logs`.

### Exit Criteria
- KPI dashboard loads under SLA for target dataset.

## Step 5 — Meeting Intelligence Automation (Phase 5)
### Backend
- Calendar webhook endpoint.
- Meeting lifecycle processor (completed/cancelled).
- Queue chain: `GenerateMomJob` -> PM Approval -> `GenerateSowJob`.

### Frontend
- PM approval inbox for MOM/SOW.
- Meeting artifact viewer and version history.

### Database
- `meetings`, `meeting_artifacts`.

### Exit Criteria
- Completed meeting automatically produces draft MOM and draft SOW; cancellation produces no artifacts.

## Step 6 — Client/Vendor Portal (Phase 6)
### Backend
- External-user guards/policies.
- Read-only contractual views with scoped permissions.

### Frontend
- Separate portal shell and restricted navigation.

### Database
- Portal access tables and invitation workflow metadata.

### Exit Criteria
- Client/vendor can access only authorized projects/documents.

## Non-Functional Track (Parallel)
- Observability: structured logs, request IDs, queue metrics.
- Security: OWASP checks, policy coverage, secret rotation.
- Performance: DB indexing, cache strategy, pagination contracts.
- Delivery: GitHub Actions pipeline for test/lint/build/deploy.
