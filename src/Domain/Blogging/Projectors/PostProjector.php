<?php

declare(strict_types=1);

namespace Domain\Blogging\Projectors;

use Domain\Blogging\Actions\CreatePost;
use Domain\Blogging\Actions\UpdatePost;
use Domain\Blogging\Events\PostWasCreated;
use Domain\Blogging\Events\PostWasUpdated;
use Domain\Blogging\Models\Post;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class PostProjector  extends Projector {
  /**
   * Called On The Background When PostWasCreated Event Is Fired
   */
  public function onPostWasCreated(PostWasCreated $event): void {
    /**
     * Create The Actual Post
     */
    CreatePost::handle(
      object: $event->object,
    );
  }  
  
  /**
   * Called On The Background When PostWasUpdated Event Is Fired
   */
  public function onPostWasUpdated(PostWasUpdated $event): void {
    /**
      * Update The Actual Post
      */
    UpdatePost::handle(
      object: $event->object,
      post: Post::find($event->postID)
    );
  }

}