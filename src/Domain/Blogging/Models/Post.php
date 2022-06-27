<?php

declare(strict_types=1);


namespace Domain\Blogging\Models;

use Database\Factories\PostFactory;
use Domain\Blogging\Models\Builders\PostBuilder;
use Domain\Blogging\Models\Concerns\IsPost;
use Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\Factory;

class Post extends Model {
    use IsPost;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'uuid',
        'title',
        'slug',
        'body',
        'description',
        'published',
        'user_id'
    ];

    protected $casts = [
        'published' => 'boolean'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(
           related: User::class,
            foreignKey:'user_id'
        );
    }

    public function newEloquentBuilder($query): PostBuilder {
       return new PostBuilder(query: $query);
    }

    public static function newFactory(): Factory {
        return new PostFactory();
    }
}
