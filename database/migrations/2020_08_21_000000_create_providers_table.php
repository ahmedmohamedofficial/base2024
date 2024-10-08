<?php

use App\Enums\ProviderApproved;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('providers', function (Blueprint $table) {
      $table->id();
      $table->string('name',50);
      $table->string('country_code',5)->default('966');
      $table->string('phone',15);
      $table->string('email',50);
      $table->string('password',100);
      $table->string('avatar', 50)->nullable();
      $table->boolean('is_active')->default(false);
      $table->boolean('is_blocked')->default(false);
      $table->boolean('is_approved')->default(ProviderApproved::PENDING);
      $table->string('code', 10)->nullable();
      $table->timestamp('code_expire')->nullable();
      $table->softDeletes();
      $table->timestamp('created_at')->useCurrent();
      $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
    });
  }

  public function down() {
    Schema::dropIfExists('providers');
  }
};
