# Phase 2 Scope and Progress

## Phase 2 Modules Covered
1. Resource Allocation
2. Timesheet Management + Keka Sync

## Completed Sections

### Backend Completed
- Resource allocation APIs:
  - `GET /api/v1/projects/{project}/members`
  - `POST /api/v1/projects/{project}/members`
  - `PATCH /api/v1/project-members/{projectMember}`
- Timesheet APIs:
  - `GET /api/v1/timesheets`
  - `POST /api/v1/timesheets/sync`
- Request validation classes for resource and timesheet flows.
- Resource and timesheet resources for response mapping.
- Repositories and services for:
  - Project member allocation
  - Timesheet filtering and bulk upsert sync
- DI bindings for new repositories.

### Frontend Completed
- New pages:
  - `/resources`
  - `/timesheets`
- New reusable components:
  - `ResourceAllocationBoard`
  - `TimesheetLedger`
- API service methods for phase 2 endpoints.
- App shell navigation and middleware protection updated for new phase 2 routes.

### In Progress / Pending in Phase 2
- Role-level permission granularity for resource and timesheet actions.
- Advanced UI controls (user picker, date filters, pagination controls).
- Integration retry + observability around Keka sync jobs.
- Automated tests for controllers/services and frontend components.
