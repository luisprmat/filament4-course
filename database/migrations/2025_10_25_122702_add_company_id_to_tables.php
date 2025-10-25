<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $resources = ['products', 'orders', 'tags', 'categories'];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->resources as $resource) {
            Schema::table($resource, function (Blueprint $table) {
                $table->foreignId('company_id')->constrained();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->resources as $resource) {
            Schema::table($resource, function (Blueprint $table) {
                $table->dropConstrainedForeignId('company_id');
            });
        }
    }
};
