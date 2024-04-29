<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;
    protected $table = 'matkuls';
    protected $guarded=[];

    //menjadikan kd_matkul primary key
    protected $primaryKey = 'kd_matkul';
    //menonaktifkan angka
    public $incrementing = false;

    protected $fillable = ['kd_matkul', 'nama_matkul'];

    public function jadwal (){
        return $this->hasMany(Jadwal::class, 'kd_matkul', 'kd_matkul');
    }
}
