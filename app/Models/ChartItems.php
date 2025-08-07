<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChartItems extends Model
{
    use HasFactory, Timestamp;

    public $timestamps = true;
    protected $table = 'chart_items';
    protected $fillable = [
        'chart_id',
        'x_value',
        'y_value'
    ];
}
