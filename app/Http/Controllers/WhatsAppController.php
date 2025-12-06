<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\ContactInfo;

class WhatsAppController extends Controller
{
    /**
     * Send WhatsApp message via API
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string|max:1000',
            'name' => 'nullable|string|max:255',
        ]);

        try {
            // Get WhatsApp number from contact info
            $contactInfo = ContactInfo::getActive();
            $whatsappNumber = $contactInfo?->whatsapp ?? config('services.whatsapp.number', '+6281234567890');
            
            // Format phone number (remove non-numeric characters except +)
            $phone = preg_replace('/[^0-9+]/', '', $validated['phone']);
            
            // If phone doesn't start with +, assume it's Indonesian number
            if (!str_starts_with($phone, '+')) {
                // Remove leading 0 if exists
                if (str_starts_with($phone, '0')) {
                    $phone = substr($phone, 1);
                }
                $phone = '+62' . $phone;
            }

            // Create WhatsApp link (for web.whatsapp.com)
            $message = urlencode($validated['message']);
            $whatsappUrl = "https://wa.me/{$phone}?text={$message}";

            // If you want to use WhatsApp Business API, you can integrate here
            // For now, we'll return the WhatsApp link and log the request
            Log::info('WhatsApp message request', [
                'phone' => $phone,
                'message' => $validated['message'],
                'name' => $validated['name'] ?? 'Guest',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'WhatsApp link generated successfully',
                'data' => [
                    'whatsapp_url' => $whatsappUrl,
                    'phone' => $phone,
                    'formatted_phone' => $this->formatPhoneNumber($phone),
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('WhatsApp API error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to process WhatsApp request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get WhatsApp contact information
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getContactInfo()
    {
        try {
            $contactInfo = ContactInfo::getActive();
            
            $whatsappNumber = $contactInfo?->whatsapp ?? config('services.whatsapp.number', '+6281234567890');
            
            return response()->json([
                'success' => true,
                'data' => [
                    'whatsapp' => $whatsappNumber,
                    'formatted_whatsapp' => $this->formatPhoneNumber($whatsappNumber),
                    'whatsapp_url' => "https://wa.me/" . preg_replace('/[^0-9+]/', '', $whatsappNumber),
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('WhatsApp contact info error', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to get WhatsApp contact info',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Format phone number for display
     * 
     * @param string $phone
     * @return string
     */
    private function formatPhoneNumber($phone)
    {
        // Remove + and format Indonesian numbers
        $cleaned = preg_replace('/[^0-9]/', '', $phone);
        
        if (str_starts_with($cleaned, '62')) {
            $cleaned = substr($cleaned, 2);
            return '+62 ' . substr($cleaned, 0, 3) . '-' . substr($cleaned, 3, 4) . '-' . substr($cleaned, 7);
        }
        
        return $phone;
    }

    /**
     * Send WhatsApp message using WhatsApp Business API (if configured)
     * This method can be used with services like Twilio, WhatsApp Business API, etc.
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessageViaAPI(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'message' => 'required|string|max:1000',
        ]);

        try {
            // Check if WhatsApp API is configured
            $apiKey = config('services.whatsapp.api_key');
            $apiUrl = config('services.whatsapp.api_url');
            
            if (!$apiKey || !$apiUrl) {
                return response()->json([
                    'success' => false,
                    'message' => 'WhatsApp API is not configured. Please configure in config/services.php',
                ], 400);
            }

            // Format phone number
            $phone = preg_replace('/[^0-9+]/', '', $validated['phone']);
            if (!str_starts_with($phone, '+')) {
                if (str_starts_with($phone, '0')) {
                    $phone = substr($phone, 1);
                }
                $phone = '+62' . $phone;
            }

            // Send request to WhatsApp API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post($apiUrl, [
                'to' => $phone,
                'message' => $validated['message'],
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'WhatsApp message sent successfully',
                    'data' => $response->json(),
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to send WhatsApp message',
                'error' => $response->body(),
            ], $response->status());

        } catch (\Exception $e) {
            Log::error('WhatsApp API send error', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to send WhatsApp message',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

