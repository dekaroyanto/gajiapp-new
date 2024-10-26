<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $guarded = [];

    public function gajis()
    {
        return $this->hasMany(Gaji::class);
    }
}
