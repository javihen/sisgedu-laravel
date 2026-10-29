<?php

namespace App\Http\Middleware;

use App\Support\ProyectoGradoAccess;
use Closure;
use Illuminate\Http\Request;

class EnsureProjectScheduleAccess
{
    public function handle(Request $request, Closure $next)
    {
        abort_unless(ProyectoGradoAccess::canManageSchedule(), 403);

        return $next($request);
    }
}
