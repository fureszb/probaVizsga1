<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bejegyzesek extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'bejegyzesek';
    protected $fillable = [
        'tevekenyseg_id',
        'osztaly_id',
        'osztlay_nev',
        'allapot'
    ];

    public function tevekenyseg()
    {
        return $this->belongsTo(Tevekenyseg::class, 'tevekenyseg_id');
    }
}
