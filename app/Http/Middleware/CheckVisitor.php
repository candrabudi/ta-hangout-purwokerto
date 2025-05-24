<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;

class CheckVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $visitorId = $request->cookie('visitor_id');

        if (!$visitorId || !Visitor::where('id', $visitorId)->exists()) {
            $visitor = Visitor::create([
                'device_info' => $request->userAgent(),
            ]);
            $visitorId = $visitor->id;
            $response = $next($request);
            return $response->cookie('visitor_id', $visitorId, 60 * 24 * 365);
        }

        return $next($request);
    }
}
