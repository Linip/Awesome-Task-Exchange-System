<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Wnikk\LaravelAccessRules\AccessRules;

class CreateRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccessRules::newRule(
            'tasks.create',
            'Новые таски может создавать кто угодно'
        );

        AccessRules::newRule(
            'tasks.shuffle',
            'Менеджеры или администраторы должны иметь кнопку «заассайнить задачи»',
        );

        AccessRules::newRule(
            'tasks.view.its',
            'Каждый сотрудник должен иметь возможность видеть в отдельном месте список заассайненных на него задач',
        );

        AccessRules::newRule(
            'tasks.complete.its',
            'Завершить задачу, поставленную на тебя',
        );
    }
}
