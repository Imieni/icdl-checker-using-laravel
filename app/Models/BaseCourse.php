<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseCourse extends Model
{
    use HasFactory;

    protected $table = 'basemodule';
    protected $primarykey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';

    public function basesubmit(){
        return $this->hasOne(BaseModule::class);
    }

}
