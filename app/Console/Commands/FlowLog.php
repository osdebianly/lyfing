<?php

namespace App\Console\Commands;

use App\Models\Flow;
use Illuminate\Console\Command;
use App\Models\Access\User\User;

class FlowLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flow:log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '生成用户流量日志';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            $flow = new Flow();
            $flow->user_id = $user->id;
            $flow->up = $user->u;
            $flow->down = $user->d;
            $flow->flow = $user->u + $user->d;
            $flow->save();
        }
    }
}