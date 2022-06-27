<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Posts\UpdateRequest;
use Domain\Blogging\Factories\PostFactory as FactoriesPostFactory;
use Domain\Blogging\Jobs\UpdatePost;
use Domain\Blogging\Models\Post;
use Illuminate\Http\Response;
use JustSteveKing\StatusCode\Http;

class UpdateController extends Controller {
    
    public function __invoke(UpdateRequest $request,Post $post): Response {
        // authorize

        //update
        UpdatePost::dispatch(
            $post->id,
            FactoriesPostFactory::create(
                attributes:$request->validated()
            ),
        );

        //return
        return response(
            content: null,
            status: Http::ACCEPTED
        );
    }
}
