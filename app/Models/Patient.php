<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['name', 'birth_date', 'gender', 'phone_number', 'created_by'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function vitals()
    {
        return $this->hasMany(Vital::class);
    }

    public function diagnosis()
    {
        return $this->hasMany(Diagnose::class);
    }
}
