<?php
namespace App\Repositories\Category;

use Auth;
use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use DB;
use Illuminate\Container\Container;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    protected $container;

    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    function model()
    {
        return Category::class;
    }
}
