<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\MqttService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MqttController extends Controller
{
    protected $mqttService;

    public function __construct(MqttService $mqttService)
    {
        $this->mqttService = $mqttService;
    }

    public function publish()
    {
        $this->mqttService->connect();
        $this->mqttService->publish('my/topic', 'Hello, MQTT!');
        $this->mqttService->disconnect();

        return response()->json(['status' => 'Message published']);
    }

    public function subscribe()
    {
        $this->mqttService->connect();
        $this->mqttService->subscribe('my/topic', function (string $topic, string $message) {
            Log::info("Received message from {$topic}: {$message}");
        });
        $this->mqttService->disconnect();

        return response()->json(['status' => 'Subscribed to topic']);
    }
}
