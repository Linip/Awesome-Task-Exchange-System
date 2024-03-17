<?php

namespace App\Providers;

use App\Commands\CompleteTaskCommand;
use App\Commands\CompleteTaskHandler;
use App\Commands\CreateTaskCommand;
use App\Commands\CreateTaskHandler;
use App\Commands\ShuffleTasksCommand;
use App\Commands\ShuffleTasksHandler;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Joselfonseca\LaravelTactician\Bus;
use Joselfonseca\LaravelTactician\CommandBusInterface;
use Joselfonseca\LaravelTactician\Locator\LaravelLazyLocator;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(CommandBusInterface::class, static function (Application $app) {
            $locator = new LaravelLazyLocator();
            $locator->addHandlers([
                CreateTaskCommand::class => CreateTaskHandler::class,
                CompleteTaskCommand::class => CompleteTaskHandler::class,
                ShuffleTasksCommand::class => ShuffleTasksHandler::class,
            ]);

            return new Bus(
                new HandleInflector(),
                new ClassNameExtractor(),
                $locator
            );
        });
    }
}
