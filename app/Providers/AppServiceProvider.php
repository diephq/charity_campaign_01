<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Campaign\CampaignRepositoryInterface;
use App\Repositories\Campaign\CampaignRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Contribution\ContributionRepository;
use App\Repositories\Contribution\ContributionRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(UserRepositoryInterface::class, UserRepository::class);
        App::bind(CampaignRepositoryInterface::class, CampaignRepository::class);
        App::bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        App::bind(ContributionRepositoryInterface::class, ContributionRepository::class);
    }
}
