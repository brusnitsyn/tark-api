<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('slug');
            $table->string('article')->nullable();
            $table->foreignId('brand_id')->references('id')->on('product_brands')->onDelete('cascade');
            $table->foreignId('pub_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('pub_org_id')->references('id')->on('orgs')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('product_categories')->onDelete('cascade');
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
};
