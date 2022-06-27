<?php

declare(strict_types=1);

namespace Domain\Shared\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid {
  public static function bootHasUuid(): void {
   static::creating(
      fn(Model $modal) => $modal->uuid = Str::uuid()->toString()
    );
  }

  public function getRouteKeyName(): string  {
   return 'uuid';
  }
}