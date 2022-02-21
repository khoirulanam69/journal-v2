<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailJurnal extends Model
{
    use HasFactory;
    protected $table = 'detailjurnal';

    public function jurnal()
    {
        return $this->belongsTo('Jurnal');
    }
}
