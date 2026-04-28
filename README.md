# project-management-tool

Monorepo structure for an enterprise PMO platform using Laravel 11 (backend API) and Next.js App Router (frontend).

## Repository Structure

```text
.
├── backend/                 # Laravel API app
│   ├── app/
│   │   ├── Events/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   ├── Requests/
│   │   │   └── Resources/
│   │   ├── Jobs/
│   │   ├── Models/
│   │   ├── Policies/
│   │   ├── Providers/
│   │   ├── Repositories/
│   │   └── Services/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   │   ├── factories/
│   │   ├── migrations/
│   │   └── seeders/
│   ├── routes/
│   ├── tests/
│   ├── .env.example
│   ├── artisan
│   ├── composer.json
│   └── phpunit.xml
├── frontend/                # Next.js app
│   ├── app/
│   ├── components/
│   ├── services/
│   ├── store/
│   ├── public/
│   ├── .env.example
│   ├── middleware.ts
│   ├── next.config.ts
│   ├── package.json
│   ├── postcss.config.js
│   ├── tailwind.config.ts
│   └── tsconfig.json
├── docs/
│   └── solution-architecture.md
└── docker-compose.yml
```

## Quick Start

1. Copy environment files:
   - `cp backend/.env.example backend/.env`
   - `cp frontend/.env.example frontend/.env.local`
2. Start containers:
   - `docker compose up -d`
3. Install dependencies:
   - Backend: `cd backend && composer install`
   - Frontend: `cd frontend && npm install`

## Notes
- Backend follows Controller → Service → Repository pattern.
- Frontend uses Next.js App Router with an API service layer.
- Redis is used for async jobs/queues.


## Step-by-Step Delivery
- Follow `docs/implementation-roadmap.md` to roll out Phases 1-6 incrementally.
- Each phase includes backend APIs, frontend UI, DB migrations, and integration checkpoints.
