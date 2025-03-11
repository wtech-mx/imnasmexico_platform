<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignRequest;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::all();
        return view('ajax.campaigns', compact('campaigns'));
    }

    public function store(StoreCampaignRequest $request)
    {
        $campaign = new Campaign();
        $campaign->name = $request->name;
        $campaign->template_id = $request->template_id;
        $campaign->waba_phone_id = $request->waba_phone_id;
        $campaign->total_messages = count(explode(',', $request->phone_numbers));
        $campaign->save();

        return response()->json(['message' => 'Campaign created successfully', 'campaign' => $campaign], 201);
    }

    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);
        return response()->json($campaign);
    }

    public function update(StoreCampaignRequest $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->name = $request->name;
        $campaign->template_id = $request->template_id;
        $campaign->waba_phone_id = $request->waba_phone_id;
        $campaign->save();

        return response()->json(['message' => 'Campaign updated successfully', 'campaign' => $campaign]);
    }

    public function destroy($id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->delete();

        return response()->json(['message' => 'Campaign deleted successfully']);
    }
}
