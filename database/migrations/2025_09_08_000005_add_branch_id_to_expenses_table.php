<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id')->nullable()->after('id');
            // Uncomment below to add a foreign key constraint if needed:
            // $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
        });
    }
    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('branch_id');
        });
    }
};
