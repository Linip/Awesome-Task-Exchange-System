<?php

namespace App\Models\Rbac;

use App\Events\RbacInheritanceAdded;
use App\Events\RbacInheritanceDeleted;
use Illuminate\Support\Facades\Event;
use Wnikk\LaravelAccessRules\Contracts\Owner as OwnerContract;

class Owner extends \Wnikk\LaravelAccessRules\Models\Owner
{
    /**
     * @inheritDoc
     * @param OwnerContract $parent
     * @return bool
     */
    public function addInheritance(OwnerContract $parent): bool
    {
        $isAdded = parent::addInheritance($parent);
        if ($isAdded) {
            Event::dispatch(new RbacInheritanceAdded($this, $parent));
        }
        return $isAdded;
    }

    /**
     * @inheritDocs
     * @param OwnerContract $parent
     * @return int
     */
    public function remInheritance(OwnerContract $parent): int
    {
        $result = parent::remInheritance($parent);
        if ($result > 0) {
            Event::dispatch(new RbacInheritanceDeleted($this, $parent));
        }
        return $result;
    }
}
