<?php

namespace App\Providers;

use App;
use Session;
use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Campaign\CampaignRepositoryInterface;
use App\Repositories\Campaign\CampaignRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Contribution\ContributionRepository;
use App\Repositories\Contribution\ContributionRepositoryInterface;
use App\Repositories\Comment\CommentRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Rating\RatingRepository;
use App\Repositories\Rating\RatingRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Follow\FollowRepository;
use App\Repositories\Follow\FollowRepositoryInterface;
use App\Repositories\Action\ActionRepository;
use App\Repositories\Action\ActionRepositoryInterface;
use App\Repositories\Message\MessageRepository;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Group\GroupRepository;
use App\Repositories\Group\GroupRepositoryInterface;
use App\Repositories\Event\EventRepository;
use App\Repositories\Event\EventRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Session::put('locale', 'vi');

        Validator::extendImplicit('campaign', 'App\Validation\CampaignValidate@campaign');
        Validator::extendImplicit('amount', 'App\Validation\ContributionValidate@amount');
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
        App::bind(CommentRepositoryInterface::class, CommentRepository::class);
        App::bind(RatingRepositoryInterface::class, RatingRepository::class);
        App::bind(FollowRepositoryInterface::class, FollowRepository::class);
        App::bind(ActionRepositoryInterface::class, ActionRepository::class);
        App::bind(MessageRepositoryInterface::class, MessageRepository::class);
        App::bind(GroupRepositoryInterface::class, GroupRepository::class);
        App::bind(EventRepositoryInterface::class, EventRepository::class);
    }
}
