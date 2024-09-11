<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Notifications\Notifiable;
use App\Enums\InstructorRequestStatus;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
//use Spatie\Permission\Traits\HasRoles;
/**
 * @method static OnlyInstructors()
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia ; //, HasRoles;

    protected $hidden = [
        'remember_token',
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->getAttribute('first_name') . ' ' . $this->getAttribute('last_name'),
        );
    }
    public function mangemnet()
    {
        return $this->belongsTo(Mangement::class ,'mangement_id' ,'id') ;
    }
}
