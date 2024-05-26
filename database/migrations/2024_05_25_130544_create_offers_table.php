<?php

use App\Constants\Status;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create( 'offers', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId( 'seller_id' )->constrained( 'users' );
            $table->string( 'title' );
            $table->text( 'description' );
            $table->float( 'price' );
            $table->string( 'status' )->default( Status::DRAFT );
            $table->timestamps();
            $table->softDeletes();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table( 'offers', function ( Blueprint $table ) {
            $table->dropForeign( ['seller_id'] );
            $table->dropIfExists();
        } );
    }
};