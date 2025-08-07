<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartCategories extends Model
{
    use HasFactory ,Timestamp;

    public $timestamps = true;
    protected $table = 'chart_categories';
    protected $fillable = [
        'title'
    ];
}
