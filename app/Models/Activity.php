<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    // ✅ Include 'created_by' so it's mass assignable
    protected $fillable = ['title', 'description', 'created_by'];

    public function logs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    // ✅ Optional relationship to the user who created the activity
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
