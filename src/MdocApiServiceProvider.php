<?php

namespace Digitonic\MdocApi;

use Digitonic\MdocApi\Contracts\MdocApi;
use Digitonic\MdocApi\Exceptions\InvalidConfig;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class MdocApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('mdoc-api.php'),
            ], 'config');

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'mdoc-api');

        $this->app->bind(MdocApi::class, function () {
            $config = config('mdoc-api');

            $this->guardAgainstInvalidConfig($config);

            $guzzle = new Client([
                'base_uri' => $config['base_url'],
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $config['api_key']
                ],
            ]);

            return new \Digitonic\MdocApi\Client($guzzle);
        });
    }

    /**
     * @param  array|null  $config
     */
    protected function guardAgainstInvalidConfig(array $config = null)
    {
        if (empty($config['base_url'])) {
            throw InvalidConfig::baseUrlNotSpecified();
        }

        if (empty($config['api_key'])) {
            throw InvalidConfig::apiKeyNotSpecified();
        }
    }
}
