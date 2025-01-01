<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Solutionforest\FilamentEmail2fa\Interfaces\RequireTwoFALogin;
use Solutionforest\FilamentEmail2fa\Trait\HasTwoFALogin;
use Spatie\Permission\Traits\HasRoles;
use Filament\Panel;

class User extends Authenticatable implements RequireTwoFALogin, FilamentUser
{
    use HasTwoFALogin;
    use HasRoles;
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'mobile_number',
        'password',
        'province',
        'is_active',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mobile_number_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected static function booted(): void
    {
        static::creating(function (User $user){
            $user->assignRole('user');
        });
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
    public function licenses()
    {
        return $this->hasMany(\App\Models\Product\License::class, 'user_id');
    }
}
