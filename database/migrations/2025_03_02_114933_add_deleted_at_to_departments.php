<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up() {
            Schema::table('colleges', function (Blueprint $table) {
                if (!Schema::hasColumn('colleges', 'deleted_at')) {
                    $table->softDeletes(); 
                }
            });
        }
    
        public function down() {
            Schema::table('colleges', function (Blueprint $table) {
                $table->dropSoftDeletes(); 
            });
        }
    };