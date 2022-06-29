<?php 

declare(strict_types=1);

use Domain\Blogging\Models\Post;
use Domain\Shared\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use JustSteveKing\StatusCode\Http;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;


beforeEach(fn() => $this->post = Post::factory()->create());

/**
 * Endpoint Tests
 */
it('tests the index route for posts',function () {
  get(route('api:v1:posts:index')) // 1st, Hit This Endpoint
  /**
   * Testing The Status Code Expected In The JSON Response
   */
    ->assertStatus(Http::OK) //Ensure Its Http Status OK Otherwise Close Early Cz Any Other Tests Will Fail
    /**
     * Testing The Content Of The JSON Response
     */
    ->assertJson(function(AssertableJson $json) { //In The Json We Have Got
      $json->has(key:1) // Check If Its Of Size 1 (Cz We Have Just Created 1)
          ->first(function(AssertableJson $json) { // Now, Lets Focus On The 1st One (Ie, The 1st Post)
            $json->where('uuid',$this->post->uuid) // Ensure That The Id We Are Expecting (From The Rsp) Is Equal To The Created Post (In The DB)
                ->where('attributes.title',$this->post->title) // Ensure That The Title We Are Getting (From The Rsp) Is Equal To The Title Of The Post Created (In The DB)
                ->etc(); // Inform Laravel That There Are Other Attributes In The JSON Expected But Have Not Been Asserted In The Test
          });
    });
});

it('tests the ability to create a new post',function () {
  User::factory()->create();
  
  post(route('api:v1:posts:store'),[
    'title' => 'Test Post',
    'description' => 'Test Post Description',
    'body' => 'Test Post Body'
  ])->assertNoContent(Http::ACCEPTED);
});
 
it('tests the ability to show an existing post',function () {
  get(route('api:v1:posts:show',$this->post->uuid))
    ->assertStatus(Http::OK)
    ->assertJson(function (AssertableJson $json) {
      $json->where('uuid',$this->post->uuid)
      ->where('attributes.title',$this->post->title)
      ->missing('relationships.author')
      ->etc();
    });
});
 
it('tests the ability to show an existing post with the author information',function () {
  get("/api/v1/posts/{$this->post->uuid}?include=user")
    ->assertStatus(Http::OK)
    ->assertJson(function (AssertableJson $json) {
      $json->where('uuid',$this->post->uuid)
      ->where('attributes.title',$this->post->title)
      ->has('relationships')
      ->where('relationships.author',null) // null Cz We Created A Post (Via The Factory) But No User Attached To It
      ->etc();
    });
});

it('tests the ability to update a post',function () {
  $newTitle = "New Title";
  
  /**
   * Before Update
   */
  expect($this->post)->title->toBe($this->post->title);

  /**
   * Updating
   */
  User::factory()->create();
  patch(
    route('api:v1:posts:update',$this->post->uuid),
    array_merge(
      $this->post->toArray(),
      ['title' => $newTitle]
    )
  )->assertNoContent(Http::ACCEPTED);

  /**
   * After Updates
   */
  $this->post->refresh();
  expect($this->post)->title->toBe($newTitle);
});

it('tests the ability to delete a post',function () {
  /**
   * Before Delete
   */
  assertDatabaseHas('posts',[
    'id' => $this->post->id,
    'title' => $this->post->title
  ]);
  assertNull($this->post->deleted_at);

  /** 
   * Deleting
  */
  delete(route('api:v1:posts:delete',$this->post->uuid))
    ->assertStatus(Http::ACCEPTED);

  /**
   * After Delete
   */
  $this->post->refresh();
  assertNotNull($this->post->deleted_at);
});