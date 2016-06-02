<?php

namespace App\Listeners;

use Log ;
use App\Helpers\Tools ;
use App\Models\Access\User\User ;
use App\Events\IpWasChanged;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IpWasChangedListener
{
    private $mailer ;
    /**
     * Create the event listener.
     *
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer ;
    }

    /**
     * Handle the event.
     *
     * @param  IpWasChanged  $event
     * @return void
     */
    public function handle(IpWasChanged $event)
    {
        $newIP = $event->serveIP;
        $users = User::all() ;
        foreach($users as $user){
           if(! in_array($user->email,env('NOT_SEND_EMAIL',['admin@admin.com','public@public.com']))){

               $this->mailer->send('backend.notice.emails.newip', ['serveIP' =>$newIP,'userName'=>$user->name], function ($message) use ($user) {
                   $message->from(env('MAIL_USERNAME','admin@admin.com'), 'New IP');
                   $message->subject('SS Auto Notice');
                   $message->to($user->email);
               });
               Log::info( 'has send email to '.$user->email) ;

           }
            echo  'skip '. $user->email.PHP_EOL ;
            sleep(1) ;
        }

    }
}
