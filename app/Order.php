<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'discount_id',
        'pay_time',
        'total_price',
        'status',          /// 1.success   2.pending   3.canceled
        'bank',            ///  for example :  1.ZarrinPall   2.Pasargad
        'ref_id',
    ];

    protected $appends=[
      'orderStatus'
    ];

    public function getOrderStatusAttribute()
    {
        if ($this['status'] == 1){
            return 'success';
        }elseif ($this['status'] == 2){
            return 'pending';
        }else{
            return 'canceled';
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address()
    {
        return $this->hasOne(Address::class);
    }

}
