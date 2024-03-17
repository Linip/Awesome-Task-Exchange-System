<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Concerns\ValidatesAttributes;

class UserCreated
{
    use Dispatchable, SerializesModels, ValidatesAttributes;

    public string $public_id;
    public string $name;
    public string $email;

    /**
     * Create a new event instance.
     */
    public function __construct(array $data)
    {
        Validator::validate($data, [
            'event_name' => [
                'string'
            ],
            'public_id' => [
                'required',
                'uuid',
            ],
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
            ],
        ]);

        $this->__unserialize($data);
    }
}
