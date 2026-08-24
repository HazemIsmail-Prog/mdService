<?php

namespace App\Models;

use App\Enums\IncreaseTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Increase extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'increase_date' => 'date:Y-m-d',
        'type' => IncreaseTypeEnum::class,

    ];

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }
}
