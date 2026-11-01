<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'technologies')) {
                $table->text('technologies')->nullable();
            }
            if (!Schema::hasColumn('projects', 'soft_skills')) {
                $table->text('soft_skills')->nullable();
            }
            if (!Schema::hasColumn('projects', 'documentation')) {
                $table->text('documentation')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['technologies', 'soft_skills', 'documentation']);
        });
    }
};