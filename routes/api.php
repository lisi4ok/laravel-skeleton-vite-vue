<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;
use Tighten\Ziggy\Ziggy;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request): mixed {
    return $request->user();
});

Route::get('ziggy/{group?}', fn ($group = null): JsonResponse => response()->json(
    $group === null ? new Ziggy : new Ziggy([$group])
));

Route::post('/tvm/ticket/create', function (): JsonResponse {
    $service = new App\Services\TVMService;
    $body = <<<JSON
{
  "description": "Details about the issue...",
  "subject": "Support Needed...",
  "email": "tom@outerspace.com",
  "priority": 1,
  "status": 2,
  "cc_emails": [
    "ram@freshdesk.com",
    "diana@freshdesk.com"
  ],
  "custom_fields": {
    "category": "Primary"
  }
}
JSON;


    try {
        $response = $service->create($body);
    } catch (Throwable $exception) {
        if ($exception->hasResponse()) {
            return response()->json([
                'error' => true,
                'message' => $exception->getMessage(),
                'code' => $exception->getResponse()->getStatusCode(),
            ]);
        }
    }

    if ($response->getStatusCode() == 201 && ($body = $response->getBody())) {
        return response()->json([
            'error' => false,
            'success' => true,
            'message' => 'Successfully created ticket',
            'code' => 201,
            'data' => $body,
        ]);
    }

    return response()->json([]);

})->name('tvm-create-ticket');
