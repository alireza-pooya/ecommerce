<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
        'mobile',
        'image',
        'gender',                  //0.woman  1.man
        'password',
    ];
    protected static $imageFields = [
        'image'
    ];
    protected $appends = array(
        'genderStatus',
    );

    public function getGenderStatusAttribute()
    {
        if ($this['gender'] == 1) {
            return 'man';
        } else {
            return 'woman';
        }
    }

    public function isManager()       /// has manager permission or not
    {
        if (in_array($this->id, [1, 2 , 3]))  //id
            return true;
        else
            return false;
    }

    public function isAdmin()
    {
        if (in_array($this->id, [3])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
