<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'desc',
        'report_id',
        'sdate',
        'stime',
     ]; 

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    } 
}