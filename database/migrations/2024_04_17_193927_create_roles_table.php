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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name', 100);
            $table->string('role_desc', 500);
            $table->timestamps();
        });

        DB::statement("INSERT INTO `roles` (`id`, `role_name`, `role_desc`, `created_at`, `updated_at`) VALUES 
        (NULL, 'Admin', 'Admin', UTC_TIMESTAMP(), UTC_TIMESTAMP()), 
        (NULL, 'Manager', 'Manager', UTC_TIMESTAMP(), UTC_TIMESTAMP()),
        (NULL, 'Staff', 'Staff', UTC_TIMESTAMP(), UTC_TIMESTAMP());");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
