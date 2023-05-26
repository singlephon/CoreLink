<?php

namespace Singlephon\Corelink\Middleware;

use Closure;
use App\Models\Service;
use http\Exception\BadMethodCallException;
use Illuminate\Http\Request;
use Singlephon\Corelink\Intentions\Security;

class ChildServiceAuth
{
    use Security;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->method() === 'POST') {
            $serviceName = $request->header('service-name');
            $checksum = $request->header('checksum');

            if (!$serviceName or !$checksum) return response()->json(['message' => 'Wrong service name or checksum at header'], 400);

            $service = Service::findByName($serviceName) or response()->json(['message' => 'Wrong credentials (service name)'])->throwResponse();

            if (!$this->assertChecksum($request->getContent(), $service->key, $checksum))
                return response()->json(['message' => 'Bad checksum'], 401);

            return $next($request);
        }
        return response()->json(['message' => 'Only POST method allowed'], 404);
    }
}
