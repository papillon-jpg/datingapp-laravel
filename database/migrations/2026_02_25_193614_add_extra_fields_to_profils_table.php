<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('profils', function (Blueprint $table) {
        $table->string('prezime')->nullable()->after('ime');

        // za koga sam zainteresiran/a
        // npr: 'musko', 'zensko', 'oba'
        $table->enum('zainteresovan_za', ['musko', 'zensko', 'oba'])->nullable()->after('spol');

        $table->unsignedTinyInteger('min_godine')->nullable()->after('datum_rodjenja');
        $table->unsignedTinyInteger('max_godine')->nullable()->after('min_godine');
    });
}

public function down(): void
{
    Schema::table('profils', function (Blueprint $table) {
        $table->dropColumn(['prezime', 'zainteresovan_za', 'min_godine', 'max_godine']);
    });
}
};
