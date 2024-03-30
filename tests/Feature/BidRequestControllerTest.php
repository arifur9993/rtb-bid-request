<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Campaign;

class BidRequestControllerTest extends TestCase
{
    use RefreshDatabase; 

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function handles_valid_bid_request_and_selects_proper_campaign()
    {
        // Create a campaign in the database that should match the bid request
        Campaign::create([
            'campaignname' => 'High Bid Campaign',
            'advertiser' => 'Test Advertiser',
            'code' => '123ABC',
            'appid' => 'com.example.app',
            'dimension' => '320x480', // Make sure this matches one of the bid request formats
            'hs_os' => 'android',
            'country' => 'BD',
            'price' => 0.5,
            'bidtype' => 'CPM',
            'image_url' => 'https://example.com/banner.png',
        ]);

        // Simulate a valid bid request
        $response = $this->json('POST', '/api/bid-request', [
            'app' => [
                'bundle' => 'com.example.app',
            ],
            'device' => [
                'os' => 'Android',
                'geo' => ['country' => 'BD'],
            ],
            'imp' => [[
                'bidfloor' => 0.1,
                'banner' => [
                    'format' => [
                        ['w' => 320, 'h' => 480], // This should match the campaign's dimension
                    ],
                ],
            ]],
        ]);

        // Check if the response is successful and contains the expected campaign
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'campaignname' => 'High Bid Campaign',
        ]);
    }

    /** @test */
    public function handles_invalid_bid_request()
    {
        $response = $this->json('POST', '/api/bid-request', []);

        // 400 is used for bad requests
        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'Invalid bid request',
        ]);
    }

    /** @test */
    public function valid_request_with_no_matching_campaigns_returns_error()
    {
        // Ensure no campaign matches the bid request
        Campaign::query()->delete(); // Clears the campaigns table

        // Simulate a valid bid request
        $response = $this->json('POST', '/api/bid-request', [
            'app' => [
                'bundle' => 'com.example.nonexistentapp',
            ],
            'device' => [
                'os' => 'Android',
                'geo' => ['country' => 'US'],
            ],
            'imp' => [[
                'bidfloor' => 5.0, // High bid floor to ensure no campaigns match
                'banner' => [
                    'format' => [
                        ['w' => 320, 'h' => 50],
                    ],
                ],
            ]],
        ]);

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'No suitable campaign found',
        ]);
    }
}
