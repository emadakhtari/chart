<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charts extends Model
{
    use HasFactory ,Timestamp;

    public $timestamps = true;
    protected $table = 'charts';
    protected $fillable = [
        'title',
        '_value',
        '_type',
        'category_id'
    ];
}
