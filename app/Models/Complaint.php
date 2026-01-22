<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $table = 'complaint';

    protected $fillable = [
        'client_id',
        'complaint_location',
        'complaint_description',
        'complaint_status',
    ];

    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(client::class);
    }
}
