<?php

namespace App\External\Events\Outgoing;

use App\External\Events\Event;
use App\Models\User;
use Override;

class UserCreated extends Event
{

    /**
     * @param User $user
     */
    public function __construct(protected User $user)
    {
    }

    #[Override] public function toArray(): array
    {
        return [
            'public_id' => $this->user->public_id,
            'name' => $this->user->name,
            'email' => $this->user->email,
        ];
    }
}
