<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nis',
        'kelas',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Admin dan siswa boleh login ke panel.
    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, ['admin', 'siswa'], true);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function pengaduans(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }
}