<?php

use JustSteveKing\StatusCode\Http;

use function Pest\Laravel\get;

it('tests the status code for static pages',function($page) {
  get($page)->assertStatus(Http::OK);
})->with(['/']);