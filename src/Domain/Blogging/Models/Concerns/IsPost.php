<?php

declare(strict_types=1);

namespace Domain\Blogging\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait IsPost {
  public static function bootIsPost(): void {
    static::creating(function (Model $model) {
      $model->uuid = Str::uuid()->toString();
      $model->slug = Str::slug($model->title);
    });
  }
}