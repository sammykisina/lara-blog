<?php

use Domain\Blogging\Factories\PostFactory;
use Domain\Blogging\ValueObjects\PostValueObject;

it('can create a new post value object using the factory', function () {
 
  $data = [
    'title' => 'Post Test Title',
    'description' => 'Post Test Description',
    'body' => 'Post Test Body',
    'published' => true
  ];

  $object = PostFactory::create (
    attributes: $data
  );

  expect($object)->toBeInstanceOf(class: PostValueObject::class);
  expect($object->toArray())->toEqual(expected:$data);
});