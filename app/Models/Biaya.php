<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;
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
