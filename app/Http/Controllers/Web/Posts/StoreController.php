<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Posts\StoreRequest;
use Domain\Blogging\Aggregates\PostAggregate;
use Domain\Blogging\Factories\PostFactory;
use Domain\Blogging\Jobs\CreatePost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class StoreController extends Controller {

    public function __invoke(StoreRequest $request): RedirectResponse {
       CreatePost::dispatch(
            PostFactory::create(
                attributes: $request->validated()
            )
        );

      return redirect()->route(route: 'home');
    }
}
