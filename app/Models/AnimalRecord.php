<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalRecord extends Model
{
    use HasFactory;

    protected $table = 'animal_record';

    protected $fillable = [ 
        'rescuer_id',
        'rescuer_name',
        'animal_species',
        'date',
        'medical_condition',
        'record_status',
    ];

    protected $attributes = [
        'record_status' => 'pending', 
    ];

    public $timestamps = false;

    public function rescuer()
    {
        return $this->belongsTo(Rescuer::class);
    }

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
