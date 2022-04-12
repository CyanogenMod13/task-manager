<?php

namespace App\Console\Commands;

use App\Mail\TaskEstimateExpiredMail;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mail;

class TaskEstimateReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind the user about the estimate';

    public function handle(): int
    {
        Task::with(['creator', 'executor'])
            ->whereNotNull('creator_id')
            ->whereDate('end', '<=', now()->addDay())
            ->get()
            ->whenEmpty(fn() => $this->info('Nothing to send'))
            ->each(function (Task $task) {
                $this->comment('Processing Task ID: ' . $task->id);
                $users = [$task->creator];
                if ($task->executor) {
                    $users[] = $task->executor;
                }
                Mail::to($users)
                    ->queue(new TaskEstimateExpiredMail($task));
                //$this->info('Task processed');
            });
        $this->info('Done');
        return 0;
    }
}
