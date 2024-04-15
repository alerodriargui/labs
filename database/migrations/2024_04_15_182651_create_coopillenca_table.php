<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('address', function (Blueprint $table) {
            $table->id('id');
            $table->string('direction')->nullable();
            $table->string('number')->nullable();
            $table->string('CP')->nullable();
            $table->string('observations')->nullable();
        });

        Schema::create('contract', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('client_id')->nullable()->index('client_id');
            $table->unsignedBigInteger('responsible_id')->nullable()->index('responsible_id');
            $table->date('datefinished')->nullable();
            $table->string('observations')->nullable();
        });

        Schema::create('garden', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('address_id')->nullable()->index('address_id');
            $table->unsignedBigInteger('owner_id')->nullable()->index('owner_id');
            $table->string('contactname')->nullable();
            $table->string('contactnumber')->nullable();
            $table->boolean('ispublic')->nullable()->default(false);
        });

        Schema::create('item_job', function (Blueprint $table) {
            $table->id('id');
            $table->string('description')->nullable();
            $table->decimal('hourly_rate', 10, 0)->nullable();
        });

        Schema::create('order', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('client_id')->nullable()->index('client_id');
            $table->unsignedBigInteger('address_id')->nullable()->index('address_id');
            $table->enum('status', ['Pending', 'OnProcess', 'Completed', 'Incidence', 'Growing'])->nullable();
        });

        Schema::create('owner', function (Blueprint $table) {
            $table->id('id');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('DNI')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
        });


        Schema::create('plant', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('scientific_name');
            $table->enum('season', ['spring', 'summer', 'autum', 'winter'])->nullable();
            $table->text('description')->nullable();
            $table->decimal('unit_price', 8, 2);
            $table->string('img_path')->nullable();
        });

        Schema::create('plant_in_garden', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('plant_id')->nullable()->index('plant_id');
            $table->unsignedBigInteger('garden_id')->nullable()->index('garden_id');
        });

        Schema::create('plant_order', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('order_id')->nullable()->index('order_id');
            $table->unsignedBigInteger('plant_id')->nullable()->index('plant_id');
            $table->integer('amount')->nullable()->default(1);
        });

        Schema::create('repeater_contract', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('contract_id')->nullable()->index('contract_id');
            $table->integer('frequency')->nullable();
        });

        Schema::create('route', function (Blueprint $table) {
            $table->id('id');
            $table->date('date')->nullable();
        });

        Schema::create('route_stop', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('route_id')->nullable()->index('route_id');
            $table->unsignedBigInteger('address_id')->nullable()->index('address_id');
            $table->boolean('completed')->nullable();
        });

        Schema::create('task', function (Blueprint $table) {
            $table->id('id');
            $table->enum('status', ['Pending', 'OnProcess', 'Completed', 'Incidence', 'Growing'])->nullable();
            $table->time('time_spent')->nullable();
            $table->unsignedBigInteger('worker_id')->nullable()->index('worker_id');
            $table->unsignedBigInteger('contract_id')->nullable()->index('contract_id');
            $table->unsignedBigInteger('item_job_id')->nullable()->index('item_job_id');
            $table->unsignedBigInteger('route_stop_id')->nullable()->index('route_stop_id');
            $table->string('comments')->nullable();
        });

        Schema::create('tool', function (Blueprint $table) {
            $table->id('id');
            $table->string('description')->nullable();
            $table->enum('type', ['Van', 'Machine', 'Tool'])->nullable();
        });

        Schema::create('tools_on_route', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('route_id')->nullable()->index('route_id');
            $table->unsignedBigInteger('tool_id')->nullable()->index('tool_id');
        });



        Schema::create('worker_at_contract', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('contract')->nullable()->index('contract');
            $table->unsignedBigInteger('worker_id')->nullable()->index('worker_id');
        });

        Schema::create('workers_on_route', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('worker_id')->nullable()->index('worker_id');
            $table->unsignedBigInteger('route_id')->nullable()->index('route_id');
        });

        Schema::table('contract', function (Blueprint $table) {
            $table->foreign(['client_id'], 'contract_ibfk_1')->references(['id'])->on('owner')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['responsible_id'], 'contract_ibfk_2')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('garden', function (Blueprint $table) {
            $table->foreign(['address_id'], 'garden_ibfk_1')->references(['id'])->on('address')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['owner_id'], 'garden_ibfk_2')->references(['id'])->on('owner')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('order', function (Blueprint $table) {
            $table->foreign(['client_id'], 'order_ibfk_1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['address_id'], 'order_ibfk_2')->references(['id'])->on('address')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('plant_in_garden', function (Blueprint $table) {
            $table->foreign(['plant_id'], 'plant_in_garden_ibfk_1')->references(['id'])->on('plant')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['garden_id'], 'plant_in_garden_ibfk_2')->references(['id'])->on('garden')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('plant_order', function (Blueprint $table) {
            $table->foreign(['order_id'], 'plant_order_ibfk_1')->references(['id'])->on('order')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['plant_id'], 'plant_order_ibfk_2')->references(['id'])->on('plant')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('repeater_contract', function (Blueprint $table) {
            $table->foreign(['contract_id'], 'repeater_contract_ibfk_1')->references(['id'])->on('contract')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('route_stop', function (Blueprint $table) {
            $table->foreign(['route_id'], 'route_stop_ibfk_1')->references(['id'])->on('route')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['address_id'], 'route_stop_ibfk_2')->references(['id'])->on('address')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('task', function (Blueprint $table) {
            $table->foreign(['worker_id'], 'task_ibfk_1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['contract_id'], 'task_ibfk_2')->references(['id'])->on('contract')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['item_job_id'], 'task_ibfk_3')->references(['id'])->on('item_job')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['route_stop_id'], 'task_ibfk_4')->references(['id'])->on('route_stop')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('tools_on_route', function (Blueprint $table) {
            $table->foreign(['route_id'], 'tools_on_route_ibfk_1')->references(['id'])->on('route')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['tool_id'], 'tools_on_route_ibfk_2')->references(['id'])->on('tool')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('worker_at_contract', function (Blueprint $table) {
            $table->foreign(['contract'], 'worker_at_contract_ibfk_1')->references(['id'])->on('contract')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['worker_id'], 'worker_at_contract_ibfk_2')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('workers_on_route', function (Blueprint $table) {
            $table->foreign(['worker_id'], 'workers_on_route_ibfk_1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['route_id'], 'workers_on_route_ibfk_2')->references(['id'])->on('route')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        
        Schema::dropIfExists('workers_on_route');

        Schema::dropIfExists('worker_at_contract');

        Schema::dropIfExists('tools_on_route');

        Schema::dropIfExists('tool');

        Schema::dropIfExists('task');

        Schema::dropIfExists('route_stop');

        Schema::dropIfExists('route');

        Schema::dropIfExists('repeater_contract');

        Schema::dropIfExists('plant_order');

        Schema::dropIfExists('plant_in_garden');

        Schema::dropIfExists('plant');

        Schema::dropIfExists('owner');

        Schema::dropIfExists('order');

        Schema::dropIfExists('item_job');

        Schema::dropIfExists('garden');


        Schema::dropIfExists('contract');

        Schema::dropIfExists('address');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
