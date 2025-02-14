<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'start_date',
        'end_date',
        'status',
    ];

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with Plan
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
