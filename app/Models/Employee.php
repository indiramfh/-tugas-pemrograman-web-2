<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'employee_number',
    'name',
    'email',
    'phone',
    'position',
    'department',
    'employment_status',
    'joined_at',
])]
class Employee extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'joined_at' => 'date',
        ];
    }
}