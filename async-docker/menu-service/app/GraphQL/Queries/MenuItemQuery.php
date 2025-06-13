<?php

namespace App\GraphQL\Queries;

use App\Models\MenuItem;

class MenuItemQuery
{
    public function getMenuItems($root, array $args)
    {
        return MenuItem::all();
    }

    public function getMenuItem($root, array $args)
    {
        return MenuItem::find($args['id']);
    }
}
