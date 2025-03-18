<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function subscribe(Request $request)
    {
        if ($request->hub_verify_token === config('meta.webhook_token')) {
            return $request->hub_challenge;
        }

        return response()->json(['error' => 'Invalid verify token'], 400);
    }

    public function webhook(Request $request)
    {
        $this->verifySignature($request);
        $this->redirectRequestIfNeeded($request);
        $data = $request->all()['entry'][0]['changes'][0];

        switch ($data['field']) {
            case 'messages':
                // Process incoming messages
                break;
            case 'message_template_status_update':
                // Handle message template status updates
                break;
        }
    }

    private function redirectRequestIfNeeded(Request $request)
    {
        if (! config('meta.webhook_redirect')) {
            return;
        }

        Http::post(config('meta.webhook_redirect'), $request->all());
    }

    private function verifySignature(Request $request)
    {
        if (! config('meta.webhook_verify_signature')) {
            return;
        }

        $secret = config('meta.app_secret');
        $signature = $request->header('x-hub-signature') ?? '';
        $payload = $request->getContent();
        $expected = 'sha1='.hash_hmac('sha1', $payload, $secret);

        if (! hash_equals($expected, $signature)) {
            abort(403, 'Invalid signature');
        }
    }
}
