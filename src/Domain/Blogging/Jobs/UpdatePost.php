<?php

declare(strict_types=1);

namespace Domain\Blogging\Jobs;

use Domain\Blogging\Actions\UpdatePost as UpdatePostAction;
use Domain\Blogging\Aggregates\PostAggregate;
use Domain\Blogging\Models\Post;
use Domain\Blogging\ValueObjects\PostValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class UpdatePost implements ShouldQueue {
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable; 
    use SerializesModels;

    public function __construct(
        public int $postID,
        public PostValueObject $object
    ){}

    public function handle(): void {
        $post = Post::find($this->postID);
        PostAggregate::retrieve(
            uuid: $post->uuid
        )->updatePost(
            object: $this->object,
            postID: $post->id
        )->persist();
    }
}
