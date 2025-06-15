public function up()
{
    Schema::create('activity_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('activity_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['pending', 'done'])->default('pending');
        $table->text('remarks')->nullable();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->timestamp('logged_at');
        $table->timestamps();
    });
}
