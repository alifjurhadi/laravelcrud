<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    
    protected $fillable = ['nama','telpon','alamat','foto'];

    public function getFoto()
    {
        if (!$this->foto) {
            return asset('images/default.png');
        }
        return asset('images/' . $this->foto);
    }

    public function mapel()
    {
        return $this->hasMany(Mapel::class);
    }
}
