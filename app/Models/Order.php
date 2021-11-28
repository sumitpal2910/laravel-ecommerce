<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "user_id",
        "state_id",
        "district_id",
        'name',
        'email',
        'phone',
        'alt_phone',
        'pincode',
        'address',
        'city',
        'landmark',
        'notes',
        'payment_type',
        'payment_method',
        'transaction_id',
        'currency',
        'amount',
        'order_number',
        'invoice_no',
        'order_date',
        'order_month',
        'order_year',
        'confirmed_date',
        'processing_date',
        'picked_date',
        'shiped_date',
        'delivered_date',
        'return_date',
        'return_reason',
        'status'
    ];

    /**
     * -------------------------------------------------
     *  ----    Relation    ----
     * -------------------------------------------------
     */

    /**
     * State
     */
    public function state()
    {
        return $this->hasOne(ShipState::class);
    }

    /**
     * District
     */
    public function district()
    {
        return $this->hasOne(ShipDistrict::class);
    }
}
