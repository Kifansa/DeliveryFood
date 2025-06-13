<?php

namespace App\GraphQL\Mutations;

use App\Models\MenuItem;

class MenuItemMutation
{
    public function createMenuItem($root, array $args)
    {
        return MenuItem::create([
            'name' => $args['name'],
            'description' => $args['description'],
            'price' => $args['price'],
            'category' => $args['category'],
        ]);
    }

    public function updateMenuItem($root, array $args)
    {
        $menuItem = MenuItem::find($args['id']);

        if ($menuItem) {
            $menuItem->update([
                'name' => $args['name'],
                'description' => $args['description'],
                'price' => $args['price'],
                'category' => $args['category'],
            ]);
            return $menuItem;
        }

        return null;
    }

    public function deleteMenuItem($root, array $args)
    {
        $menuItem = MenuItem::find($args['id']);

        if ($menuItem) {
            $menuItem->delete();
            return $menuItem;
        }

        return null;
    }
}
