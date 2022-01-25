<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = rand(0, 10);

        $orders = Order::all();
        $products = Product::all();
        $total = 0;

        foreach ($orders as $order) {
            OrderItem::factory($count)->make()->each(function ($item) use ($order, $products, $total) {
                $product = $products->random();

                $color = $product->color_en ? explode(",", $product->color_en) : "";
                $size = $product->size_en ? explode(",", $product->size_en) : "";
                $price = $product->discount_price > 0 ? $product->discount_price : $product->selling_price;

                $item->order_id = $order->id;
                $item->product_id = $product->id;
                $item->size = $size ? $size[rand(0, (count($size) - 1))] : '';
                $item->color = $color ? $color[rand(0, (count($color) - 1))] : '';
                $item->price = $price;
                $item->save();

                $total += $price;
            });
        }
        $order->update(['amount' => $total]);
    }
}
