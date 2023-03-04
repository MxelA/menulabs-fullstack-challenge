<?php

namespace App\Console\Commands;

use App\Exceptions\WeatherServiceErrorException;
use App\Jobs\UserWeatherUpdateJob;
use App\Repositories\UserRepository\IUserRepository;
use App\Services\User\IUserWeatherService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UserWeatherUpdateCommand extends Command
{
    private IUserRepository $userRepository;
    private IUserWeatherService $userWeatherService;

    public function __construct(IUserRepository $userRepository, IUserWeatherService $userWeatherService)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->userWeatherService = $userWeatherService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:weather-update {takeUsers}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update users weather data';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $takeUsers = $this->argument('takeUsers');

        $users = $this->userRepository->getUsersThatNeedToUpdateWeatherData($takeUsers);

        foreach ($users as $user) {
            try {
                UserWeatherUpdateJob::dispatch($user, $this->userWeatherService);
            } catch (\Exception $e) {
                Log::alert('Update user Weather have error: ' . $e->getMessage());
                continue;
            }
        }

    }
}
