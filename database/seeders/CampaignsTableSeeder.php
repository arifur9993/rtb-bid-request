<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campaign::truncate();
        $campaigns = [
            $this->createCampaign(
                'Android Campaign',
                '118965F12BE33FB7A',
                'com.ludo.king',
                0.1,
                'Android', 
                'BGD',
                '320x50'
            ),
            $this->createCampaign(
                'Android Campaign 2',
                '118965F12BE33FB77B',
                'com.ludo.king',
                0.1,
                'Android', 
                'BGD',
                '320x480' 
            ),
            $this->createCampaign(
                'iOS Campaign',
                '118965F12BE33FB7B',
                'com.ludo.king',
                0.2,
                'iOS',
                'BGD',
                '776x393' 
            ),
            $this->createCampaign(
                'iOS Campaign 2',
                '118965F12BE33FB7c',
                'com.ludo.king',
                0.2,
                'iOS',
                'BGD',
                '750x200' 
            ),
        ];

        foreach ($campaigns as $campaign) {
            DB::table('campaigns')->insert($campaign);
        }
    }

    private function createCampaign($name, $code, $appId, $price, $osTarget, $countryTarget, $dimension)
    {
        return [
            'campaignname' => $name,
            'advertiser' => 'TestGP',
            'code' => $code,
            'appid' => $appId,
            'tld' => 'https://example.com/',
            'portalname' => '',
            'creative_type' => 1,
            'creative_id' => rand(100000, 999999),
            'day_capping' => 0,
            'dimension' => $dimension,
            'attribute' => 'rich-media',
            'url' => 'https://example.com/',
            'billing_id' => rand(100000, 999999),
            'price' => $price,
            'bidtype' => 'CPM',
            'image_url' => 'https://example.com/banner' . rand(1, 10) . '.png',
            'htmltag' => '',
            'from_hour' => 0,
            'to_hour' => 23,
            'hs_os' => $osTarget,
            'operator' => 'All',
            'device_make' => 'No Filter',
            'country' => $countryTarget,
            'city' => '',
            'lat' => null,
            'lng' => null,
            'app_name' => null,
            'user_list_id' => 0,
            'adplay_logo' => 1,
            'vast_video_duration' => null,
            'logo_placement' => 1,
            'hs_model' => null,
            'is_rewarded_inventory' => 0,
            'pixel_tag' => null,
            'dmp_campaign_audience' => 0,
            'platform' => null,
            'open_publisher' => 1,
            'audience_targeting' => 0,
            'native_title' => null,
            'native_type' => null,
            'native_data_value' => null,
            'native_data_cta' => null,
            'native_data_rating' => null,
            'native_data_price' => null,
            'native_img_icon' => null,
        ];
    }
}
