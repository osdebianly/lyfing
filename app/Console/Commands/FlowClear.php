<?php

namespace App\Console\Commands;

use App\Models\Flow;
use Illuminate\Console\Command;


class FlowClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flow:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清理之前的日志记录';

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
        //删除一个月前的记录
        $startDate = date('Y-m-d H:i:s', strtotime('-1 month'));
        Flow::where('created_at', '<', $startDate)->delete();
    }
}