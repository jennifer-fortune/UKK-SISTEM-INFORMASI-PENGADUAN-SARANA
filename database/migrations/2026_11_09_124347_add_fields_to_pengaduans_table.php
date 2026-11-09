
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            $table->string('lokasi');
            $table->text('deskripsi');
            $table->string('status')->default('Menunggu');
            $table->text('feedback')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['category_id']);

            $table->dropColumn([
                'user_id',
                'category_id',
                'lokasi',
                'deskripsi',
                'status',
                'feedback',
            ]);
        });
    }
};
