<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory, Timestamp;

    public $timestamps = true;
    protected $table = 'clients';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'username',
        'password',
        'status'
    ];
}
