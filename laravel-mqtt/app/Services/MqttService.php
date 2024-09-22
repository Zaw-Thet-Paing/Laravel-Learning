<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\Exceptions\MqttClientException;
use PhpMqtt\Client\MqttClient;

class MqttService
{
    protected $mqtt;

    public function __construct()
    {

        $this->mqtt = new MqttClient(
            config('mqtt.host'),
            config('mqtt.port'),
            config('mqtt.client_id')
        );
    }

    public function connect()
    {
        try {
            // Prepare connection settings (username, password, clean session)
            $connectionSettings = (new ConnectionSettings)
                ->setUsername(config('mqtt.username'))
                ->setPassword(config('mqtt.password'));

            // Establish connection
            $this->mqtt->connect($connectionSettings);
            Log::info('MQTT connected successfully.');
        } catch (MqttClientException $e) {
            Log::error('MQTT connection failed: ' . $e->getMessage());
        }
    }

    public function publish($topic, $message, $qos = 0)
    {
        try {
            $this->mqtt->publish($topic, $message, $qos);
        } catch (MqttClientException $e) {
            Log::error('MQTT publishing failed: ' . $e->getMessage());
        }
    }

    public function subscribe($topic, callable $callback, $qos = 0)
    {
        try {
            $this->mqtt->subscribe($topic, $callback, $qos);
        } catch (MqttClientException $e) {
            Log::error('MQTT subscription failed: ' . $e->getMessage());
        }
    }

    public function disconnect()
    {
        $this->mqtt->disconnect();
    }

}
