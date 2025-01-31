<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockWidget extends Model
{
    use HasFactory;

    protected $table = 'block_widget';

    protected $fillable = [
        'widget_id',
        'block',
        'type',
        'settings'
    ];
    //settings alawse convert to object

    protected $casts = [
        'settings' => 'object',
    ];

    // تعریف رابطه با مدل Widget
    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }

}
