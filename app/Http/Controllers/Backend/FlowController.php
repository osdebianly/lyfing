<?php

namespace App\Http\Controllers\Backend;

use App\Models\Access\User\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Access\User\UserRepositoryContract;

class FlowController extends Controller
{
    /**
     * @var UserRepositoryContract
     */
    protected $users;
    public function __construct(
        UserRepositoryContract $users
    )
    {
        $this->users       = $users;
    }
    public function index()
    {
        return view('backend.flow')
            ->withUsers($this->users->getUsersPaginated(config('access.users.default_per_page'), 1));
    }
    public function update($user,$flow)
    {
        $user = User::findOrFail($user) ;
        $user->transfer_enable = $user->transfer_enable+ $flow * 1024 * 1024 * 1024 ;
        $user->save() ;
        return back() ;
    }
}
