<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delivery_requests', function (Blueprint $table) {
            $table->id();
            $table->text('pickup_address');
            $table->text('pickup_name');
            $table->string('pickup_contact_no');
            $table->text('pickup_email')->nullable();
            $table->text('delivery_address');
            $table->text('delivery_name');
            $table->string('delivery_contact_no');
            $table->text('delivery_email')->nullable();
            $table->integer('type_of_good')->comment('1: Document, 2: Parcel');
            $table->integer('delivery_provider')->comment('1: DHL, 2: STARTRACK, 3: ZOOM2U, 4: TGE');
            $table->integer('priority')->comment('1: Standard, 2: Express, 3: Immediate');
            $table->date('shipment_pickup_date');
            $table->time('shipment_pickup_time');
            $table->text('package_description');
            $table->integer('length')->comment('cm');
            $table->integer('height')->comment('cm');
            $table->integer('width')->comment('cm');
            $table->integer('weight')->comment('g');
            $table->integer('status')->comment('0: pending, 1: cancel, 2: processed, 3: shipped')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_requests');
    }
};
