<?php

namespace Cart\Models
{
    use Illuminate\Database\Eloquent\Model;

    class Product extends Model
    {
        public function hasLowStock() : bool
        {
            if ($this->outOfStock()) {
                return false;
            }

            return (bool) ($this->stock <= 5);
        }

        public function outOfStock() : bool
        {
            return $this->stock === 0;
        }

        public function inStock() : bool
        {
            return $this->stock >= 1;
        }

        public function hasStock($quantity) : bool
        {
            return $this->stock >= $quantity;
        }

//        public function order()
//        {
//            return $this->belongsToMany(Order::class, 'orders_products')->withPivot('quantity');
//        }
    }
}
