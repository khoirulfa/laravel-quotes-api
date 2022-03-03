<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory, HasUuid;

    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    protected $fillable = ['quote', 'length', 'slug', 'author', 'category_uuid'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
