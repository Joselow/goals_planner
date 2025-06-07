<?php

namespace App\Events;

use App\Models\Category;
use App\Models\Goal;
use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $goal;
    public function __construct(Goal|Category $goal)
    { 
        $this->goal = $goal;
    }

  
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
