<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntermediateCourse extends Model
{
    use HasFactory;

    protected $table = 'intermediatemodule';
    protected $primarykey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';

    public function intermediatesubmit(){
        return $this->hasOne(Intermediate::class);
    }
}
