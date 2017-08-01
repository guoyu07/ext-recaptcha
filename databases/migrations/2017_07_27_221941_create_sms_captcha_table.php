<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsCaptchaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sms_captcha', function(Blueprint $table) {
            $table->increments('id');
            $table->string('tel',13)->nullable()->unique();
            $table->integer('code')->nullable();
            $table->boolean('is_valid')->nullable()->default(true);
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
        Schema::dropIfExists('sms_captcha');
    }
}
