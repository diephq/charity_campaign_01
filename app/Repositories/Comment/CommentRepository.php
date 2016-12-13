<?php
namespace App\Repositories\Comment;

use Auth;
use App\Models\Comment;
use App\Repositories\BaseRepository;
use App\Repositories\Comment\CommentRepositoryInterface;
use DB;
use Illuminate\Container\Container;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{

    protected $container;

    public function __construct(Container $container)
    {
        parent::__construct($container);
    }

    function model()
    {
        return Comment::class;
    }

    public function createComment($params = [])
    {
        if (empty($params)) {
            return false;
        }

        return $this->model->create([
            'name' => isset($params['name']) ? $params['name'] : null,
            'email' => isset($params['email']) ? $params['email'] : null,
            'user_id' => auth()->id(),
            'campaign_id' => $params['campaign_id'],
            'text' => $params['text'],
        ]);
    }

    public function getDetail($id)
    {
        if (!$id) {
            return false;
        }

        return $this->model->with('user')->find($id);
    }
}
