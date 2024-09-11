<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $table = 'admins'; // Adjust table name if necessary
    public function kheta()
    {
        return $this->belongsTo(Kheta::class , 'kheta_id') ;
    }
}
