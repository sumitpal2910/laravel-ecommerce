<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'comment',
        'summary',
        'status',
    ];
    
    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */

    /**
     * user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
