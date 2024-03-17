<?php

namespace App\Models;

use App\Models\Rbac\Owner;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Wnikk\LaravelAccessRules\Models\Inheritance;

class Role extends Owner
{
    /**
     * @inheritDoc
     * @return Builder
     */
    public function newQuery(): Builder
    {
        return parent::newQuery()
            ->where(
                "{$this->getTable()}.type",
                '=',
                Owner::getTypeID('Role')
            );
    }

    /**
     * @return Builder
     */
    public function newUserRelationQuery(): Builder
    {
        $inheritance_table = (new Inheritance())->getTable();
        $owner_table = $this->getTable();

        return $this->newQuery()
            ->select("$owner_table.*")
            ->join($inheritance_table, function (JoinClause $join) use ($owner_table, $inheritance_table) {
                $join->on("$owner_table.id", '=', "$inheritance_table.owner_parent_id");
            })
            ->join("$owner_table as user_owner", function (JoinClause $join) use ($inheritance_table) {
                $join->on("$inheritance_table.owner_id", '=', 'user_owner.id')
                    ->where('user_owner.type', '=', Owner::getTypeID(User::class));
            });
    }


}
