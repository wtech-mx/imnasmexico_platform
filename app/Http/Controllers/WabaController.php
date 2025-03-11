<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Waba;
use App\Services\WabaManagerService;

class WabaController extends Controller
{
    public function init(Request $request)
    {
        $wabaId = $request->input('waba_id');
        $wabaManager = new WabaManagerService();

        $wabaInfo = $wabaManager->getWabaInfo($wabaId);
        $phoneNumbers = $wabaManager->getPhoneNumbers($wabaId);
        $templates = $wabaManager->getAllTemplates($wabaId);

        return response()->json([
            'waba_info' => $wabaInfo,
            'phone_numbers' => $phoneNumbers,
            'templates' => $templates,
        ]);
    }

    public function loadTemplatesFromWaba(Request $request)
    {
        $wabaId = $request->input('waba_id');
        $wabaManager = new WabaManagerService();
        $templates = $wabaManager->getAllTemplates($wabaId);

        return response()->json($templates);
    }

    public function getWabaInfo(Request $request)
    {
        $wabaId = $request->input('waba_id');
        $wabaManager = new WabaManagerService();
        $wabaInfo = $wabaManager->getWabaInfo($wabaId);

        return response()->json($wabaInfo);
    }

    public function getWabaPhones(Request $request)
    {
        $wabaId = $request->input('waba_id');
        $wabaManager = new WabaManagerService();
        $phones = $wabaManager->getPhoneNumbers($wabaId);

        return response()->json($phones);
    }
}
