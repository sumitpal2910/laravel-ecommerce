<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'name'
    ];



    /**
     * ---------------------------------------
     *  ---- RELATIONSHIP ----
     * ---------------------------------------
     */
    /**
     * User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return  $this->belongsTo(Folder::class, 'parent_id', 'id');
    }

    /**
     * child
     */
    public function childrens()
    {
        return $this->hasMany(Folder::class, 'parent_id', 'id');
    }
}
