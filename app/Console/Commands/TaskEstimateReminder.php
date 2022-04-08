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
    protected $signature = 'task:remind {task : ID of task}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind the user about the estimate';

    public function handle(): int
    {
        $task = Task::find($this->argument('task'));
        if (!$task) {
            $this->error('Task not found');
            return -1;
        }
        if (!$task->end) {
            $this->info('Task has no date of expire');
            return 0;
        }
        if (!$task->executor_id) {
            $this->info('Task has no executor');
            return 0;
        }

        $end = Carbon::createFromTimeString($task->end);
        $diff = now()->diffInDays($end);
        if ($diff <= 1) {
            $user = User::find($task->executor_id);
            Mail::to($user)->queue(new TaskEstimateExpiredMail($task));
            $this->info('Mail put in queue');
        }
        return 0;
    }
}
