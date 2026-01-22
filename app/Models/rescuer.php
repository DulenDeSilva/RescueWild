<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rescuer extends Model
{
    use HasFactory;

    protected $table ='rescuer';

    protected $primaryKey ='id';

    protected $fillable = [
        'user_id',
        'rescuer_location',

    ];

    public $timestamps = false;

    function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}