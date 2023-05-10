<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {

    protected $table = 'order_items';

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'color', 'size'];

    protected $hidden = [];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
