import { NextResponse } from 'next/server';
import type { NextRequest } from 'next/server';

export function middleware(request: NextRequest) {
  const token = request.cookies.get('pmo_token')?.value;
  const isProtected = ['/dashboard', '/projects', '/tasks', '/resources', '/timesheets']
    .some((route) => request.nextUrl.pathname.startsWith(route));

  if (isProtected && !token) {
    return NextResponse.redirect(new URL('/login', request.url));
  }

  return NextResponse.next();
}

export const config = {
  matcher: ['/dashboard/:path*', '/projects/:path*', '/tasks/:path*', '/resources/:path*', '/timesheets/:path*'],
};
