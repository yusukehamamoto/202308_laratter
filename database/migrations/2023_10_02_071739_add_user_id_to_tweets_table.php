

public function up()
{
  Schema::table('tweets', function (Blueprint $table) {
    // 🔽 1行追加
    $table->foreignId('user_id')->after('id')->nullable()->constrained()->cascadeOnDelete();
  });
}

public function down()
{
  Schema::table('tweets', function (Blueprint $table) {
    // 🔽 2行追加
    $table->dropForeign(['user_id']);
    $table->dropColumn(['user_id']);
  });
}

