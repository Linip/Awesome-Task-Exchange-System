<?php

namespace App\Models;

use App\Events\TaskCreated;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $public_id
 * @property integer $executor_id
 * @property string $name
 * @property string $description
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class Task extends Model
{
    use HasUuids;

    protected $dispatchesEvents = [
        'created' => TaskCreated::class,
    ];

    /**
     * @inheritDoc
     * @return string[]
     */
    public function uniqueIds(): array
    {
        return [
            'public_id',
        ];
    }

    /**
     * @inheritdoc
     * @var string[]
     */
    protected $fillable = [
        'public_id',
        'executor_id',
        'name',
        'description',
        'status',
    ];

    /**
     * @return $this
     */
    public function complete(): static
    {
        $this->status = Status::Completed->name;

        return $this;
    }
}
