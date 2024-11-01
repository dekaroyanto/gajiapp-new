<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{

    public function getTotalInshadirAttribute()
    {
        return $this->insentif * $this->hadir;
    }

    public function getTotalupahAttribute()
    {
        return $this->gpokok + $this->gjabatan + $this->oprs + $this->service + $this->hp;
    }

    public function getTotalgajiAttribute()
    {
        return $this->total_inshadir + $this->gpokok + $this->gjabatan + $this->oprs + $this->service + $this->hp;
    }

    public function getGajiakhirAttribute()
    {
        return $this->totalgaji + $this->thr - ($this->angsuran + $this->bpjs + $this->kasbon);
    }

    protected $guarded = [];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
