<?php

use Domain\Blogging\Models\Post;

use function Pest\Laravel\assertDatabaseCount;

it('can scope our query to only published posts', function () {
  $posts = Post::factory(10)->create(['published' => true]);
  Post::factory(10)->create(['published' => false]);
  assertDatabaseCount('posts',20);

  expect(
    Post::published()->count()
  )->toEqual(10);

  expect(
    Post::draft()->count()
  )->toEqual(10);
});