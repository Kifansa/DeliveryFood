<?php

namespace App\GraphQL\Mutations;

use App\Models\MenuItem;
use Illuminate\Support\Facades\Queue;
use App\Jobs\PublishMenuUpdateEvent;

class MenuItemMutation
{
    public function createMenuItem($root, array $args)
    {
        $menuItem = MenuItem::create([
            'name' => $args['name'],
            'description' => $args['description'],
            'price' => $args['price'],
            'category' => $args['category'],
        ]);

        $this->dispatchMenuUpdateEvent($menuItem);

        return $menuItem;
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
    
    public function dispatchMenuUpdateEvent(MenuItem $menuItem)
    {
        PublishMenuUpdateEvent::dispatch($menuItem);
    }
}
