<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('todos', 'title')) {
            DB::statement('ALTER TABLE todos RENAME COLUMN title TO note');
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('todos', 'note')) {
            DB::statement('ALTER TABLE todos RENAME COLUMN note TO title');
        }
    }
};
