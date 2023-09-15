<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biaya extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    // protected $table = 'biaya';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($biaya) {
            $biaya->user_id = auth()->id();
        });

        static::updating(function ($biaya) {
            $biaya->user_id = auth()->id();
        });
    }
}
