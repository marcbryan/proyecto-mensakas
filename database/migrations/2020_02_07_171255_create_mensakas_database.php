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
        // 1. Keys
        Schema::create('keys', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('key_name', 60);
        });

        // 2. Superusers
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

        // 3. Consumers
        Schema::create('consumers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash', 60)->nullable();
            $table->string('first_name', 25);
            $table->string('last_name', 50);
            $table->tinyInteger('status')->default(1);
            $table->string('email')->unique();
            $table->bigInteger('facebook_id')->nullable();
            $table->bigInteger('google_id')->nullable();
            $table->string('address');
            $table->string('zipcode', 5);
            $table->string('phone', 23);
            $table->rememberToken();
            $table->timestamps();
        });

        // 4. Deliverer
        Schema::create('deliverers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash', 60)->nullable();
            $table->string('first_name', 25);
            $table->string('last_name', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('level')->nullable();
            $table->tinyInteger('vehicle_id')->nullable();
            $table->string('device_id', 170)->nullable();
            $table->integer('telegram_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // 5. Business Users
        Schema::create('business_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hash', 60)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('level')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // 6. Token Sent
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

        // 7. Deliverer Status
        Schema::create('deliverer_status', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 30);
        });

        // 8. Deliverer TimeTable
        Schema::create('deliverer_timetable', function (Blueprint $table) {
            $table->unsignedBigInteger('deliverer_id');
            $table->tinyInteger('day');
            $table->time('start');
            $table->time('end');

            $table->foreign('deliverer_id')->references('id')->on('deliverers');
        });

        // 9. Deliverer Location
        Schema::create('deliverer_location', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->decimal('lat', 11, 8);
          $table->decimal('lon', 11, 8);
          $table->string('provider', 4);
          $table->decimal('precision', 6, 3);
          $table->unsignedBigInteger('deliverer_id');

          $table->foreign('deliverer_id')->references('id')->on('deliverers');
        });

        // 10. Business
        Schema::create('business', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name', 40);
          $table->string('address', 200);
          $table->decimal('lat', 14, 8)->nullable();
          $table->decimal('lon', 14, 8)->nullable();
          $table->tinyInteger('status')->default(1);
          $table->string('phone', 26);
          $table->string('email')->unique();
          $table->string('zipcode', 5);
          $table->string('place_id', 40)->nullable();
          $table->tinyInteger('affiliated')->default(0);
          $table->timestamps();
        });

        // 11. Business Devices
        Schema::create('business_devices', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('business_id');
          $table->string('deviceUuid', 36);
          $table->string('deviceToken', 64);
          $table->string('deviceAlias', 32);
          $table->timestamps();
          $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
        });

        // 12. Business TimeTable
        Schema::create('business_timetable', function (Blueprint $table) {
            $table->unsignedBigInteger('business_id');
            $table->tinyInteger('day');
            $table->time('open');
            $table->time('close');

            $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
        });

        // 13. Category
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('key_id');
            $table->string('internal_name', 20);
            $table->tinyInteger('for_adults')->default(0);
            $table->string('background', 64)->nullable();
            $table->string('type', 2)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('icon', 255)->nullable();
            $table->string('color', 64)->nullable();

            $table->foreign('key_id')->references('id')->on('keys');
        });

        // 14. Business Categories
        Schema::create('business_categories', function (Blueprint $table) {
          $table->unsignedBigInteger('business_id');
          $table->unsignedBigInteger('category_id');

          $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
          $table->foreign('category_id')->references('id')->on('categories');
        });

        // 15. Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('business_id');
            $table->tinyInteger('status')->default(1);
            $table->json('json');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('consumers');
            $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
        });

        // 16. Order Historical
        Schema::create('order_historical', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status')->default(1);
            $table->json('json');
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();

            $table->foreign('user_id')->references('id')->on('consumers');
        });

        // 17. Order Deliverer
        Schema::create('order_deliverer', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('deliverer_id');
            $table->dateTime('date');
            $table->tinyInteger('action')->nullable();

            $table->foreign('order_id')->references('id')->on('order_historical');
            $table->foreign('deliverer_id')->references('id')->on('deliverers');
        });

        // 18. Order Message
        Schema::create('order_message', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('deliverer_id');
            $table->integer('type')->nullable();
            $table->dateTime('date');
            $table->text('text');

            $table->foreign('order_id')->references('id')->on('order_historical');
            $table->foreign('deliverer_id')->references('id')->on('deliverers');
        });

        // 19. Payments
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->decimal('amount', 9, 2);
            $table->string('token', 128);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('order_historical');
        });

        // 20. Invoice Series
        Schema::create('invoice_series', function (Blueprint $table) {
          $table->string('id', 12);
          $table->string('name', 45);

          $table->primary('id');
        });

        // 21. Invoices
        Schema::create('invoices', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('order_id');
          $table->dateTime('date');
          $table->char('hash', 128);
          $table->string('series_id', 12);

          $table->foreign('order_id')->references('id')->on('order_historical');
          $table->foreign('series_id')->references('id')->on('invoice_series');
        });

        // 22. Items
        Schema::create('items', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('key_id');
          $table->tinyInteger('status')->default(1);
          $table->decimal('price', 5, 2);
          $table->char('type', 3);
          $table->unsignedBigInteger('description_key');
          $table->tinyInteger('has_extras')->default(0);
          $table->string('image_url')->nullable();

          $table->foreign('key_id')->references('id')->on('keys');
          $table->foreign('description_key')->references('id')->on('keys');
        });

        // 23. Extras
        Schema::create('extras', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('business_id');
          $table->unsignedBigInteger('key_id');
          $table->decimal('price', 5,2);
          $table->tinyInteger('group')->nullable();

          $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
          $table->foreign('key_id')->references('id')->on('keys');
        });

        // 24. Item Extras
        Schema::create('item_extras', function (Blueprint $table) {
          $table->unsignedBigInteger('item_id');
          $table->unsignedBigInteger('extra_id');
          $table->unsignedBigInteger('business_id');

          $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
          $table->foreign('extra_id')->references('id')->on('extras')->onDelete('cascade');
          $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
        });

        // 25. Menus
        Schema::create('menus', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('key_id');
          $table->unsignedBigInteger('business_id');
          $table->decimal('price', 5,2);
          $table->tinyInteger('status')->default(1);
          $table->integer('sort');

          $table->foreign('key_id')->references('id')->on('keys');
          $table->foreign('business_id')->references('id')->on('business')->onDelete('cascade');
        });

        // 26. Menu Items
        Schema::create('menu_items', function (Blueprint $table) {
          $table->unsignedBigInteger('menu_id');
          $table->unsignedBigInteger('item_id');

          $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
          $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });

        // 27. Menu TimeTable
        Schema::create('menu_timetable', function (Blueprint $table) {
          $table->unsignedBigInteger('menu_id');
          $table->unsignedBigInteger('key_id');
          $table->time('start');
          $table->time('end');

          $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
          $table->foreign('key_id')->references('id')->on('keys');
        });

        // 28. Idioma (ES)
        Schema::create('ES', function (Blueprint $table) {
          $table->unsignedBigInteger('key_id');
          $table->string('text');

          $table->foreign('key_id')->references('id')->on('keys');
        });

        // 29. Idioma (CAT)
        Schema::create('CAT', function (Blueprint $table) {
          $table->unsignedBigInteger('key_id');
          $table->string('text');

          $table->foreign('key_id')->references('id')->on('keys');
        });

        // 30. Idioma (EN)
        Schema::create('EN', function (Blueprint $table) {
          $table->unsignedBigInteger('key_id');
          $table->string('text');

          $table->foreign('key_id')->references('id')->on('keys');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('superusers');
        Schema::dropIfExists('consumers');
        Schema::dropIfExists('deliverers');
        Schema::dropIfExists('business_users');
        Schema::dropIfExists('token_sent');
        Schema::dropIfExists('deliverer_status');
        Schema::dropIfExists('deliverer_timetable');
        Schema::dropIfExists('deliverer_location');
        Schema::dropIfExists('business');
        Schema::dropIfExists('business_devices');
        Schema::dropIfExists('business_timetable');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('business_categories');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_historical');
        Schema::dropIfExists('order_deliverer');
        Schema::dropIfExists('order_message');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('invoice_series');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('items');
        Schema::dropIfExists('extras');
        Schema::dropIfExists('item_extras');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menu_timetable');
        Schema::dropIfExists('keys');
        Schema::dropIfExists('ES');
        Schema::dropIfExists('CAT');
        Schema::dropIfExists('EN');
    }
}
