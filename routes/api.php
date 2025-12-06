<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// WhatsApp API Routes
Route::prefix('whatsapp')->name('api.whatsapp.')->group(function () {
    // Get WhatsApp contact information
    Route::get('/contact', [WhatsAppController::class, 'getContactInfo'])->name('contact');
    
    // Send WhatsApp message (generates WhatsApp web link)
    Route::post('/send', [WhatsAppController::class, 'sendMessage'])->name('send');
    
    // Send WhatsApp message via API (requires WhatsApp Business API configuration)
    Route::post('/send-api', [WhatsAppController::class, 'sendMessageViaAPI'])->name('send-api');
});

