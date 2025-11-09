// database/migrations/2025_08_27_000001_create_meetings_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id('meeting_id');
            $table->string('meeting_type');
            $table->date('date');
            $table->time('start_time');
            $table->string('agenda')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('meetings');
    }
};
