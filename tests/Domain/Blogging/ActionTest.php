<?php

use Domain\Blogging\Actions\CreatePost;
use Domain\Blogging\Actions\UpdatePost;
use Domain\Blogging\Models\Post;
use Domain\Blogging\ValueObjects\PostValueObject;
use Domain\Shared\Models\User;

// it('can create a post from a value object', function () {

//   User::factory()->create();

//   $data = [
//     'title' => 'New Post Test Title',
//     'description' => ' New Post Test Description',
//     'body' => 'new Post Test Body',
//     'published' => true 
//   ];

//   $object = new PostValueObject(
//     $data['title'],
//    $data['body'],
//     $data['description'],
//      $data['published']
//   );

//   expect(
//     CreatePost::handle(
//       $object
//     )
//   )->toBeInstanceOf(Post::class);
// });

it('can update a post from a value object and a post modal', function () {

  $user = User::factory()->create();
  $data = $user->posts()->create([
    'title' => 'New Post Test Title',
    'description' => ' New Post Test Description',
    'body' => 'new Post Test Body',
    'published' => true 
  ]);

  $object = new PostValueObject(
    'Updated Title',
   $data->body,
    $data->description,
     $data->published
  );

  expect(
    UpdatePost::handle( // Testing If It Can Actually Update
      $object,
      $data
    )
  )->toBeBool()->toBeTrue(); // Check If A Boolean Is Returned Cz Update Returns A Bull

  expect($data->refresh())->title->toBe("Updated Title");
});