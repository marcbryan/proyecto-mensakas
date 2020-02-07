<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensakasDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Superusers
        Schema::create('superusers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash', 60)->nullable();
            $table->string('first_name', 25);
            $table->string('last_name', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // 2. Consumers
        Schema::create('consumers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash', 60)->nullable();
            $$table->string('first_name', 25);
            $table->string('last_name', 50);
            $table->tinyInteger('status')->default(1);
            $table->string('email')->unique();
            $table->bigInteger('facebook_id')->nullable();
            $table->bigInteger('google_id')->nullable();
            $table->string('address');
            $table->integer('zipcode');
            $table->string('phone', 23);
            $table->rememberToken();
            $table->timestamps();
        });

        // 3. Deliverer
        Schema::create('deliverers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash', 60)->nullable();
            $table->string('first_name', 25);
            $table->string('last_name', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('level');
            $table->tinyInteger('vehicle_id');
            $table->string('device_id', 170)->nullable();
            $table->integer('telegram_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // 4. Business Users
        Schema::create('business_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash', 60)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('level')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // 5. Token Sent
        Schema::create('token_sent', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('ip_address', 128);
            $table->string('network', 128);
            $table->string('user_agent', 128);
            $table->string('cookie', 128);
            $table->bigInteger('user_id')->nullable();
            $table->timestamp('created_at', 0);
        });

        // 6. Deliverer Status
        Schema::create('deliverer_status', function (Blueprint $table) {
            $table->tinyInteger('id');
            $table->string('name', 30);
        });

        // 7. Deliverer TimeTable
        Schema::create('deliverer_timetable', function (Blueprint $table) {
            $table->bigInteger('deliverer_id');
            $table->tinyInteger('day');
            $table->time('start');
            $table->time('end');

            $table->foreign('deliverer_id')->references('id')->on('deliverers');
        });

        // 8. Deliverer Location
        Schema::create('deliverer_location', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->decimal('lat', 11, 8);
          $table->decimal('lon', 11, 8);
          $table->string('provider', 4);
          $table->decimal('precision', 6, 3);
        });

        // 9. Business Devices
        Schema::create('business_devices', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('business_id');
          $table->string('deviceUuid', 36);
          $table->string('deviceToken', 64);
          $table->string('deviceAlias', 32);
          $table->timestamps();
        });

        // 10. Business
        Schema::create('business', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name', 40);
          $table->string('address', 200);
          $table->decimal('lat', 14, 8);
          $table->decimal('lon', 14, 8);
          $table->tinyInteger('status');
          $table->string('phone', 26);
          $table->string('email')->unique();
          $table->integer('zipcode');
          $table->string('place_id', 40);
          $table->tinyInteger('affiliated');
          $table->timestamps();
        });

        // 11. Business TimeTable
        Schema::create('business_timetable', function (Blueprint $table) {
            $table->integer('business_id');
            $table->tinyInteger('day');
            $table->time('open');
            $table->time('close');
        });

        // 12. Category
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('internal_name', 20);
            $table->tinyInteger('for_adults')->default(0);
            $table->string('background', 64)->nullable();
            $table->string('type', 2);
            $table->tinyInteger('status');
            $table->string('icon', 255)->nullable();
            $table->string('color', 64)->nullable();
        });

        // 13. Business Categories
        Schema::create('business_categories', function (Blueprint $table) {
          $table->integer('business_id');
          $table->bigInteger('category_id');

          $table->foreign('category_id')->references('id')->on('categories');
        });

        // 14. Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->tinyInteger('status');
            $table->json('json');
            $table->timestamps();
        });

        // 15. Order Historical
        Schema::create('order_historical', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->tinyInteger('status');
            $table->json('json');
            $table->timestamps();
        });

        // 16. Order Deliverer
        Schema::create('order_deliverer', function (Blueprint $table) {
            $table->integer('order_id');
            $table->integer('deliverer_id');
            $table->dateTime('date');
            $table->tinyInteger('action');
        });

        // 17. Order Message
        Schema::create('order_message', function (Blueprint $table) {
            $table->integer('order_id');
            $table->integer('deliverer_id');
            $table->integer('type');
            $table->dateTime('date');
            $table->text('text');
        });

        // 18. Payments
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->decimal('amount', 9, 2);
            $table->string('token', 128);
            $table->tinyInteger('status');
            $table->timestamps();
        });

        // 19. Invoices
        Schema::create('invoices', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('order_id');
          $table->dateTime('date');
          $table->char('hash', 128);
          $table->string('series_id', 12);
        });

        // 20. Invoice Series
        Schema::create('invoice_series', function (Blueprint $table) {
          $table->string('id', 12);
          $table->string('name', 45);
        });

        // 21. Items
        Schema::create('items', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('key_id');
          $table->tinyInteger('status');
          $table->decimal('price', 5, 2);
          $table->char('type', 3);
          $table->tinyInteger('has_description');
          $table->tinyInteger('has_extras');
          $table->tinyInteger('has_image');
        });

        // 22. Item Extras
        Schema::create('item_extras', function (Blueprint $table) {
          $table->integer('item_id');
          $table->integer('extra_id');
        });

        // 23. Extras
        Schema::create('extras', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('business_id');
          $table->integer('key_id');
          $table->decimal('price', 5,2);
          $table->tinyInteger('group');
        });

        // 24. Menus
        Schema::create('menus', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('key_id');
          $table->decimal('price', 5,2);
          $table->tinyInteger('status');
          $table->integer('sort');
        });

        // 25. Menu Items
        Schema::create('menu_items', function (Blueprint $table) {
          $table->integer('menu_id');
          $table->integer('item_id');
        });

        // 26. Menu TimeTable
        Schema::create('menu_items', function (Blueprint $table) {
          $table->integer('menu_id');
          $table->integer('key_id');
          $table->time('start');
          $table->time('end');
        });

        // 27. Keys
        Schema::create('keys', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('key_name', 60);
        });

        // 28. Idioma (ES)
        Schema::create('ES', function (Blueprint $table) {
          $table->bigInteger('key_id');
          $table->string('text');
        });

        // 29. Idioma (CAT)
        Schema::create('CAT', function (Blueprint $table) {
          $table->bigInteger('key_id');
          $table->string('text');
        });

        // 30. Idioma (EN)
        Schema::create('EN', function (Blueprint $table) {
          $table->bigInteger('key_id');
          $table->string('text');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // TODO: Drops
        Schema::dropIfExists('');
    }
}
