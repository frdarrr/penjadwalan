<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = ['dosen_id', 'kd_matkul', 'lab_id', 'hari', 'jam', 'kelas'];
    public function matkul (){
        return $this->belongsTo(Matkul::class, 'kd_matkul', 'kd_matkul');
    }
    public function dosen (){
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id');
    }
    public function lab (){
        return $this->belongsTo(Lab::class, 'lab_id', 'id');
    }
}
