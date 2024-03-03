<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Wnikk\LaravelAccessRules\Contracts\Owner;

class RbacInheritanceDeleted
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Owner $child,
        public Owner $parent,
    )
    {
    }
}
