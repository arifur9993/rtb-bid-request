<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->down();
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('campaignname');
            $table->string('advertiser');
            $table->string('code')->unique();
            $table->string('appid');
            $table->string('tld');
            $table->string('portalname')->nullable();
            $table->tinyInteger('creative_type');
            $table->bigInteger('creative_id');
            $table->integer('day_capping');
            $table->string('dimension');
            $table->string('attribute');
            $table->string('url');
            $table->bigInteger('billing_id');
            $table->decimal('price', 8, 2);
            $table->string('bidtype');
            $table->string('image_url');
            $table->string('htmltag')->nullable();
            $table->tinyInteger('from_hour');
            $table->tinyInteger('to_hour');
            $table->string('hs_os');
            $table->string('operator');
            $table->string('device_make')->nullable();
            $table->string('country');
            $table->string('city')->nullable();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->string('app_name')->nullable();
            $table->bigInteger('user_list_id');
            $table->boolean('adplay_logo');
            $table->integer('vast_video_duration')->nullable();
            $table->boolean('logo_placement');
            $table->string('hs_model')->nullable();
            $table->boolean('is_rewarded_inventory');
            $table->text('pixel_tag')->nullable();
            $table->boolean('dmp_campaign_audience');
            $table->string('platform')->nullable();
            $table->boolean('open_publisher');
            $table->boolean('audience_targeting');
            $table->string('native_title')->nullable();
            $table->string('native_type')->nullable();
            $table->text('native_data_value')->nullable();
            $table->text('native_data_cta')->nullable();
            $table->string('native_data_rating')->nullable();
            $table->decimal('native_data_price', 8, 2)->nullable();
            $table->string('native_img_icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
