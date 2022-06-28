<?php

declare(strict_types=1);

namespace Domain\Blogging\Actions;

use Domain\Blogging\Models\Post;
use Domain\Blogging\ValueObjects\PostValueObject;
use Illuminate\Support\Str;

class CreatePost {
   public static function handle(PostValueObject $object,string $uuid): Post {
    return Post::create(array_merge(
      $object->toArray(),
      [
        'uuid' => $uuid,
        'slug' => Str::slug($object->title),
        'user_id' => 1
      ]
    ));
   }
}