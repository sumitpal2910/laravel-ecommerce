<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('sub_subcategory_id');
            $table->string('name_en');
            $table->string('name_hin');
            $table->string('slug_en');
            $table->string('slug_hin');
            $table->string('code');
            $table->string('tags_en');
            $table->string('tags_hin');
            $table->string('size_en')->nullable();
            $table->string('size_hin')->nullable();
            $table->string('color_en');
            $table->string('color_hin');
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->longText('short_descp_en');
            $table->longText('short_descp_hin');
            $table->longText('long_descp_en');
            $table->longText('long_descp_hin');
            $table->string('thumbnail');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
