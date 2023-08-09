<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;
use Illuminate\Container\Container;

class App
{
    private Config $config;

    public function __construct(
        protected Container $container,
        protected ?Router $router = null,
        protected array $request = [],
    ) {
    }

    public function boot(): static
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        $this->config = new Config($_ENV);

        $this->container->singleton(
            EntityManager::class,
            fn() => EntityManager::create(
                $this->config->db,
                ORMSetup::createAttributeMetadataConfiguration([__DIR__ . '/Entity'])
            )
        );

        return $this;
    }

    public function run(): void
    {
        try {
            echo $this->router->resolve($this->request['uri'], strtolower($this->request['method']));
        } catch (RouteNotFoundException) {
            http_response_code(404);

            echo View::make('error/404');
        }
    }
}
