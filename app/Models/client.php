<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;

    protected $table ='client';

    protected $primaryKey ='id';

    protected $fillable = [
        'user_id',
        'client_address',

    ];


    public $timestamps = false;

    function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
