<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneBook extends Model
{
    use HasFactory;
    protected $table = 'phone_books';
    protected $fillable =[
        'id', 'name', 'phone_number', 'email', 'image',
    ];
}
