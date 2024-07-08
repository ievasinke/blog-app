<?php  declare(strict_types=1);

namespace App\Controllers\Like;

use App\RedirectResponse;
use App\Services\Like\LikeService;

class LikeController
{
    private LikeService $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function like(): RedirectResponse
    {
        if (!isset($_POST['id']) || !isset($_POST['type']))
        {
            // TODO error
            return new RedirectResponse('/articles');
        }
        $id = $_POST['id'];
        $type = $_POST['type'];

        $this->likeService->createLike((int) $id, $type);

        if ($type === 'comment')
        {
            $id = $_POST['article_id'];
        }
        return new RedirectResponse('/articles/' . $id);
    }
}