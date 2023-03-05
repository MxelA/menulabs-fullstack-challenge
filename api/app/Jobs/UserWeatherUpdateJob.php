<?php

namespace App\Jobs;

use App\Exceptions\WeatherApiServiceErrorException;
use App\Models\User;
use App\Repositories\UserRepository\IUserRepository;
use App\Services\User\IUserWeatherService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\throwException;

class UserWeatherUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private User $user;
    private IUserWeatherService $userWeatherService;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, IUserWeatherService $userWeatherService)
    {
        $this->user                 = $user;
        $this->userWeatherService   = $userWeatherService;
    }

    /**
     * Execute the job.
     * @throws \Exception
     */
    public function handle(): void
    {
        $this->userWeatherService->updateUserWeather($this->user);
    }
}
