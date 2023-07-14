<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'rnumb',
        'rdate',
        'rtime',
        'alocn',
        'apict1',
        'apict1thum',
        'apict2',
        'apict2thum',
        'apict3',
        'apict3thum',
        'afire',
        'atrap',
        'ainju',
        'user_id',        
     ];  

    public function status(): HasMany
    {
        return $this->hasMany(Status::class);
    }
     

}