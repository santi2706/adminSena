<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $addImageUrl = !Schema::hasColumn('areas', 'imagen_url');
        $addImagePublicId = !Schema::hasColumn('areas', 'imagen_public_id');

        if (!$addImageUrl && !$addImagePublicId) {
            return;
        }

        Schema::table('areas', function (Blueprint $table) use ($addImageUrl, $addImagePublicId) {
            if ($addImageUrl) {
                $table->string('imagen_url')->nullable();
            }

            if ($addImagePublicId) {
                $table->string('imagen_public_id')->nullable();
            }
        });
    }

    public function down(): void
    {
        $dropImageUrl = Schema::hasColumn('areas', 'imagen_url');
        $dropImagePublicId = Schema::hasColumn('areas', 'imagen_public_id');

        if (!$dropImageUrl && !$dropImagePublicId) {
            return;
        }

        Schema::table('areas', function (Blueprint $table) use ($dropImageUrl, $dropImagePublicId) {
            if ($dropImageUrl) {
                $table->dropColumn('imagen_url');
            }

            if ($dropImagePublicId) {
                $table->dropColumn('imagen_public_id');
            }
        });
    }
};
