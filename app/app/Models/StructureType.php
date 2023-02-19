<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StructureType extends Model
{
    use HasFactory;

    protected $table = 'structure_types';

    protected $fillable = ['type', 'title', 'description'];
}
