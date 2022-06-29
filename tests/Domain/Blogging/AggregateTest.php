<?php

use Domain\Blogging\Aggregates\PostAggregate;
use Domain\Blogging\Events\PostWasCreated;
use Domain\Blogging\Factories\PostFactory;
use Domain\Shared\Models\User;

it('can create a post',function () {
  $data = [
    'title' => 'Test Title',
    'description' => 'Test Description',
    'body' => 'Test Body',
    'published' => true
  ];

  $user = User::factory()->create();
  $object = PostFactory::create(
    attributes: $data
  );

  PostAggregate::fake()
    ->given(new PostWasCreated( // Given This Event
      object: $object,
      userID: $user->id
    )
  )->when(function(PostAggregate $aggregate) use ($object,$user) {
    $aggregate->createPost( // And This Method Called In the Root Aggregate
      object: $object,
      userID: $user->id
    );
  })->assertRecorded(new PostWasCreated( // Then This Event Must Have Been Stored
    object: $object,
    userID: $user->id
  ));
});