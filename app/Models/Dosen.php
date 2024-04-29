<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table = 'dosens';
    protected $guarded=[];
    protected $fillable = ['user_id', 'nip', 'nama', 'telp', 'email'];

    public function user (){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
