<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassList extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name'
    ];

    public function funds(){
        return $this->hasMany(ClassFunds::class, 'class_list_id');
    }

}
