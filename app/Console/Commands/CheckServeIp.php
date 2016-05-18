<?php

namespace App\Console\Commands;


use Cache;
use Event;
use Log ;
use App\Helpers\Tools;
use App\Events\IpWasChanged;
use Illuminate\Console\Command;

/**
 * Class Inspire
 * @package App\Console\Commands
 */
class CheckServeIp extends Command
{
    private $ipCacheKey = 'server_ip';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Server IP is changed';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lastIP = Cache::get($this->ipCacheKey, '');
        $currentIP = Tools::getCurrentServerIP();
        echo 'diff '.$lastIP. '  now: '.$currentIP ;
        if (!empty($lastIP)) {
            if (trim($currentIP) != $lastIP) {
                Event::fire(new IpWasChanged($currentIP));
                Cache::forget($this->ipCacheKey);
                Cache::forever($this->ipCacheKey, $currentIP);
            }
        } else {
            Cache::forever($this->ipCacheKey, '1.1.1.1');
            Log::info('first check serve ip ->'.$currentIP) ;
        }
    }
}
