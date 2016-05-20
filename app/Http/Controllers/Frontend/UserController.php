<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\InviteCode;
use App\Models\Flow;
//use Illuminate\Auth\Guard;
//use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Frontend\User\DownloadCommand ;
use App\Http\Controllers\Controller;
use App\Helpers\Tools;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use League\Flysystem\FileExistsException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;


use YoutubeDl\YoutubeDl;
use YoutubeDl\Exception\CopyrightException;
use YoutubeDl\Exception\NotFoundException;
use YoutubeDl\Exception\PrivateVideoException;

use Illuminate\Filesystem\Filesystem ;

class UserController extends Controller
{
    protected $user;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->user = access()->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $server_ip = Tools::getCurrentServerIP();
        return view('frontend.user.index', ['user' => $this->user, 'server_ip' => $server_ip]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('frontend.user.edit', ['user' => $this->user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        User::destroy($this->user->id);
        return redirect('/');
    }

    /**
     * 签到
     * @param Request $request
     * @return mixed
     */
    public function checkin(Request $request)
    {
        if (!$this->user->isAbleToCheckin()) {
            $res['msg'] = "您似乎已经签到过了...";
            $res['ret'] = 1;
            return $res;
        }
        $traffic = rand(env('CHECK_IN_MIN', 500), env('CHECK_IN_MAX', 1000));
        $this->user->transfer_enable = $this->user->transfer_enable + Tools::toMB($traffic);
        $this->user->last_check_in_time = time();
        $this->user->save();
        $res['msg'] = sprintf("获得了 %u MB流量.", $traffic);
        $res['ret'] = 1;
        return $res;
    }

    /**
     * 个人信息
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('frontend.user.profile', ['user' => $this->user]);
    }

    /**
     * 邀请码
     * @return \Illuminate\View\View
     */
    public function invite(InviteCode $inviteCode)
    {
        $inviteCode = $inviteCode->getAll($this->user->id);
        return view('frontend.user.invite', ['user' => $this->user, 'codes' => $inviteCode]);
    }

    /**
     * 流量信息
     */
    public function flow(Flow $flow)
    {

        $flows = $flow->getFlow($this->user->id);
        return view('frontend.user.flow', ['flows' => $flows]);
    }

    /**
     * 生成邀请码
     * @return mixed
     */
    public function makeInviteCode()
    {
        $n = $this->user->invite_num;
        for ($i = 0; $i < $n; $i++) {
            $char = Tools::genRandomChar(32);
            $code = new InviteCode();
            $code->code = $char;
            $code->user_id = $this->user->id;
            $code->save();
        }
        $this->user->invite_num = 0;
        $this->user->save();
        $res['ret'] = 1;
        return $res;
    }

    /**
     * 更新登陆密码
     * @param Request $request
     * @return mixed
     */
    public function updatePassword(Request $request)
    {
        $update = false;
        $oldPassword = $request->input('oldpwd');
        $newPassword = $request->input('pwd');
        if (Hash::check(trim($oldPassword), $this->user->password)) {
            // 密码匹配...
            $update = $this->user->updatePassword($newPassword);
        }
        if ($update) {
            $res['msg'] = "修改密码成功,新密码" . $newPassword;
            $res['ret'] = 1;
        } else {
            $res['msg'] = "修改密码失败";
            $res['ret'] = 0;
        }
        return $res;
    }

    /**
     * 更新登陆密码
     * @param Request $request
     * @return mixed
     */
    public function updateSS(Request $request)
    {
        $update = false;

        $newPassword = $request->input('sspwd');
        $newMethod = $request->input('method');
        $newPort = $request->input('port');
        $update = $this->user->updateSS($newPassword, $newMethod, $newPort);
        if ($update) {
            $res['msg'] = "修改成功";
            $res['ret'] = 1;
        } else {
            $res['msg'] = "修改失败";
            $res['ret'] = 0;
        }
        return $res;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function doInvite($request)
    {
        $n = $this->user->invite_num;
        if ($n < 1) {
            $res['ret'] = 0;
            return $res;
        }
        for ($i = 0; $i < $n; $i++) {
            $char = Tools::genRandomChar(32);
            $code = new InviteCode();
            $code->code = $char;
            $code->user_id = $this->user->id;
            $code->save();
        }
        $this->user->invite_num = 0;
        $this->user->save();
        $res['ret'] = 1;
        return $res;
    }

    /**
     * Download
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function download(){
        return view('frontend.user.download') ;
    }

    /**
     * Exec download command , wget or you-get
     * @param DownloadCommand $request
     */
    public function downloadCommand( DownloadCommand $request){

        $url = $request->get('url') ;
        $userPath = public_path($this->user->email) ;
        $fileSystem = new Filesystem() ;
        if(! $fileSystem->exists($userPath) ){
            try{
                $fileSystem->makeDirectory($userPath,0777,true,true) ;
            }catch(Exception $e){

            }

        }



        $dl = new YoutubeDl(['output' => '%(title)s.%(ext)s','continue' => true]);
        $dl->setTimeout(600) ;
        // For more options go to https://github.com/rg3/youtube-dl#user-content-options

        $dl->setDownloadPath($userPath);

        try {
            $video = $dl->download($url);
            dd($video) ;
            //echo $video->getTitle(); // Will return Phonebloks
        //     $dl->getFile(); // \SplFileInfo instance of downloaded file
        } catch (NotFoundException $e) {

            // Video not found
        } catch (PrivateVideoException $e) {

            // Video is private
        } catch (CopyrightException $e) {
            
            // The YouTube account associated with this video has been terminated due to multiple third-party notifications of copyright infringement
        } catch (\Exception $e) {

            // Failed to download
        }

        //$return =['error'=>1,'error_message'=>''] ;
        //$url = $request->get('url') ;
        //$command = "youtube-dl -F -J ".$url ;
        //$process = new Process($command);
        //$process->setTimeout(600) ;
        //$process->start() ;
        //$process->wait(function($type, $buffer) {
        //
        //});
        //
        //if (!$process->isSuccessful()) {
        //    return $process->getErrorOutput();
        //}
        //return $process->getOutput() ;

    }
}
