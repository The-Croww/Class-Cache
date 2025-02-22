<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassFunds extends Model
{
    use HasFactory;
    protected $fillable = [ 
                'name', 
                'description', 
                'amount', 
                'date',
                'contibutions',
                'expenses',
                'category',
                'status',
                'expenses',
                'balance'
            ];
}
