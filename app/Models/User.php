<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function checkout(Request $request) {
        $user = Auth::user();
        $plan = Plan::find($request->plan_id);

        return $user->newSubscription('default', $plan->stripe_plan_id)
            ->checkout();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function gameSessions()
    {
        return $this->hasMany(GameSession::class);
    }

    public function chatSessions()
    {
        return $this->hasMany(ChatSession::class);
    }
}
