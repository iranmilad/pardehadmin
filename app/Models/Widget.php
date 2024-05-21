<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'setup'];

    /**
     * تعیین رابطه یک به چند با مدل BlockWidget
     */
    public function blocks()
    {
        return $this->hasMany(BlockWidget::class, 'widget_id');
    }

}
