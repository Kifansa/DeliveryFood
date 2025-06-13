<?php

namespace App\Jobs;

use App\Models\MenuItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

class PublishMenuUpdateEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $menuItem;

    /**
     * Create a new job instance.
     *
     * @param  MenuItem  $menuItem
     * @return void
     */
    public function __construct(MenuItem $menuItem)
    {
        $this->menuItem = $menuItem;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'event' => 'menu-updated',
            'menu_item' => $this->menuItem,
        ];

        Queue::connection('rabbitmq')->pushRaw(json_encode($data), env('RABBITMQ_QUEUE', 'menu-updated'));
    }
}
