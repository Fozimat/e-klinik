<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = ['diagnose_id', 'medicine_id', 'pharmacist_id', 'dosage', 'notes'];

    public function diagnose()
    {
        return $this->belongsTo(Diagnose::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function pharmacist()
    {
        return $this->belongsTo(User::class);
    }
}
