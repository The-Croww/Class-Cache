<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassFunds extends Model
{
    use HasFactory;
    protected $fillable = [ 
                'class_list_id',
                'name', 
                'description', 
                'amount', 
                'contributions',
                'category',
                'date',
                'status',
            ];
    protected $casts = [
        'date' => 'datetime',
    ];
            

    public function student()
    {
        return $this->belongsTo(ClassList::class, 'class_list_id');
    }
}
