<?php

namespace App\Providers;

use App\Commands\ApplyEnrollmentTransactionCommand;
use App\Commands\ApplyEnrollmentTransactionHandler;
use App\Commands\ApplyWithdrawalTransactionCommand;
use App\Commands\ApplyWithdrawalTransactionHandler;
use App\Commands\CloseBillingCycleCommand;
use App\Commands\CloseBillingCycleHandler;
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
                ApplyEnrollmentTransactionCommand::class => ApplyEnrollmentTransactionHandler::class,
                ApplyWithdrawalTransactionCommand::class => ApplyWithdrawalTransactionHandler::class,
                CloseBillingCycleCommand::class => CloseBillingCycleHandler::class,
            ]);

            return new Bus(
                new HandleInflector(),
                new ClassNameExtractor(),
                $locator
            );
        });
    }
}
