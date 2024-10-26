<?php

namespace App\Providers;

use App\Services\GameService;
use App\Managers\WinnerManager;
use App\Helpers\GameResultHelper;
use App\Repositories\GameRepository;
use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\GameService as GameServiceContract;
use App\Managers\Contracts\WinnerManager as WinnerManagerContract;
use App\Helpers\Contracts\GameResultHelper as GameResultHelperContract;
use App\Repositories\Contracts\GameRepository as GameRepositoryContract;

class AppServiceProvider extends ServiceProvider
{
    protected array $bindingHelpers = [
        GameResultHelperContract::class => GameResultHelper::class,
    ];

    protected array $bindingServices = [
        GameServiceContract::class => GameService::class,
    ];

    protected array $bindingRepositories = [
        GameRepositoryContract::class => GameRepository::class,
    ];

    protected array $bindingManagers = [
        WinnerManagerContract::class => WinnerManager::class,
    ];

    public function register(): void
    {
        $this->registerHelpers();
        $this->registerServices();
        $this->registerRepositories();
        $this->registerManagers();
    }

    public function boot(): void {}

    private function registerHelpers(): void
    {
        foreach ($this->bindingHelpers as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    private function registerServices(): void
    {
        foreach ($this->bindingServices as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    private function registerRepositories(): void
    {
        foreach ($this->bindingRepositories as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    private function registerManagers(): void
    {
        foreach ($this->bindingManagers as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
