<?php

namespace HealthEngine\LaravelLogging\Middleware;

use Closure;
use Psr\Log\LoggerInterface;

class MonitorRequest
{
    /** @var LoggerInterface */
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $this->logger->info('Response received', ['http_status_code' => $response->status()]);

        return $response;
    }
}