<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BidRequestController extends Controller
{
    public function handleBidRequest(Request $request)
    {
        $bidRequest = $request->json()->all();

        if (!$this->validateBidRequest($bidRequest)) {
            return response()->json(['error' => 'Invalid bid request'], 400);
        }

        $selectedCampaign = $this->selectCampaign($bidRequest);

        if (!$selectedCampaign) {
            return response()->json(['error' => 'No suitable campaign found'], 404);
        }
        $compatibleCampaigns = $this->selectCampaign($bidRequest);

        if ($compatibleCampaigns->isEmpty()) {
            return response()->json(['error' => 'No suitable campaign found'], 404);
        }
        $responses = [];
        foreach ($compatibleCampaigns as $campaign) {
            $responses[] = $this->generateResponse($campaign);
        }
        return response()->json($responses);
    }

    protected function validateBidRequest(array $bidRequest): bool
    {
        $validator = Validator::make($bidRequest, [
            'imp' => 'required|array',
            'imp.*.banner' => 'required_with:imp',
            'imp.*.banner.w' => 'required_with:imp.*.banner|integer',
            'imp.*.banner.h' => 'required_with:imp.*.banner|integer',
            'imp.*.banner.format' => 'required_with:imp.*.banner|array',
            'imp.*.banner.format.*.w' => 'required_with:imp.*.banner.format|integer',
            'imp.*.banner.format.*.h' => 'required_with:imp.*.banner.format|integer',
            'imp.*.bidfloor' => 'required_with:imp|numeric',
            'imp.*.bidfloorcur' => 'required_with:imp.*.bidfloor|string',
            'app' => 'required|array',
            'app.name' => 'required_with:app|string',
            'app.bundle' => 'required_with:app|string',
            'app.publisher' => 'required_with:app|array',
            'app.publisher.id' => 'required_with:app.publisher|string',
            'device' => 'required|array',
            'device.os' => 'required_with:device|string',
            'device.geo' => 'required_with:device|array',
            'device.geo.country' => 'required_with:device.geo|string',
        ]);

        if ($validator->fails()) {
            Log::error('Bid request validation failed: ' . $validator->errors()->first());
            return false;
        }

        return true;
    }

    protected function selectCampaign(array $bidRequest)
    {
        $deviceOs = strtolower($bidRequest['device']['os'] ?? '');
        $country = strtoupper($bidRequest['device']['geo']['country'] ?? '');
        $bidFloor = $bidRequest['imp'][0]['bidfloor'] ?? 0;
        $appId = $bidRequest['app']['bundle'] ?? '';

        $compatibleCampaigns = Campaign::query()
            ->where('hs_os', '=', $deviceOs) // Adjusted for exact OS matching
            ->where(function ($query) use ($country) {
                $query->where('country', '=', $country)
                    ->orWhere('country', 'No Filter');
            })
            ->where('appid', '=', $appId)
            ->where('price', '>=', $bidFloor)
            // ->where(function ($query) use ($bidRequest) {
            //     foreach ($bidRequest['imp'][0]['banner']['format'] as $format) {
            //         $dimensionString = $format['w'] . 'x' . $format['h'];
            //         $query->orWhereJsonContains('dimension', $dimensionString);
            //     }
            // })
            ->where(function ($query) use ($bidRequest) {
                foreach ($bidRequest['imp'][0]['banner']['format'] as $format) {
                    $dimensionString = $format['w'] . 'x' . $format['h'];
                    $query->orWhere('dimension', '=', $dimensionString);
                }
            })
            ->get();

        return $compatibleCampaigns;
    }

    protected function generateResponse(Campaign $campaign): array
    {
        return [
            "campaignname" => $campaign->campaignname,
            "advertiser" => $campaign->advertiser,
            "code" => $campaign->code,
            "appid" => $campaign->appid,
            "tld" => $campaign->tld,
            "portalname" => $campaign->portalname,
            "creative_type" => $campaign->creative_type,
            "creative_id" => $campaign->creative_id,
            "day_capping" => $campaign->day_capping,
            "dimension" => $campaign->dimension,
            "attribute" => $campaign->attribute,
            "url" => $campaign->url,
            "billing_id" => $campaign->billing_id,
            "price" => $campaign->price,
            "bidtype" => $campaign->bidtype,
            "image_url" => $campaign->image_url,
            "htmltag" => $campaign->htmltag,
            "from_hour" => $campaign->from_hour,
            "to_hour" => $campaign->to_hour,
            "hs_os" => $campaign->hs_os,
            "operator" => $campaign->operator,
            "device_make" => $campaign->device_make,
            "country" => $campaign->country,
            "city" => $campaign->city,
            "lat" => $campaign->lat,
            "lng" => $campaign->lng,
            "app_name" => $campaign->app_name,
            "user_list_id" => $campaign->user_list_id,
            "adplay_logo" => $campaign->adplay_logo,
            "vast_video_duration" => $campaign->vast_video_duration,
            "logo_placement" => $campaign->logo_placement,
            "hs_model" => $campaign->hs_model,
            "is_rewarded_inventory" => $campaign->is_rewarded_inventory,
            "pixel_tag" => $campaign->pixel_tag,
            "dmp_campaign_audience" => $campaign->dmp_campaign_audience,
            "platform" => $campaign->platform,
            "open_publisher" => $campaign->open_publisher,
            "audience_targeting" => $campaign->audience_targeting,
            "native_title" => $campaign->native_title,
            "native_type" => $campaign->native_type,
            "native_data_value" => $campaign->native_data_value,
            "native_data_cta" => $campaign->native_data_cta,
            "native_data_rating" => $campaign->native_data_rating,
            "native_data_price" => $campaign->native_data_price,
            "native_img_icon" => $campaign->native_img_icon,
        ];
    }
}
