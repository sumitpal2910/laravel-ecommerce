<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("state_id");
            $table->unsignedBigInteger("district_id");
            $table->string("name");
            $table->string("email");
            $table->string("phone");
            $table->string("alt_phone")->nullable();
            $table->integer("pincode");
            $table->string("address");
            $table->string("city");
            $table->string("landmark")->nullable();
            $table->string("notes")->nullable();
            $table->string("payment_type");
            $table->string("payment_method")->nullable();
            $table->string("transaction_id")->nullable();
            $table->string("currency");
            $table->decimal("amount", 8, 2);
            $table->string("order_number");
            $table->string("invoice_no");
            $table->date("order_date");
            $table->string("order_month");
            $table->string("order_year");
            $table->date("confirmed_date")->nullable();
            $table->date("processing_date")->nullable();
            $table->date("picked_date")->nullable();
            $table->date("shiped_date")->nullable();
            $table->date("delivered_date")->nullable();
            $table->integer("return_order")->default(0);
            $table->date("return_date")->nullable();
            $table->string("return_reason")->nullable();
            $table->string("status");
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
        Schema::dropIfExists('orders');
    }
}
