<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailContact extends Model
{
    use HasFactory;

    protected $table = "email_contacts";

    protected $fillable = [
        'email', 'firstname', 'lastname', 'is_opt_in'
    ];

    
}
