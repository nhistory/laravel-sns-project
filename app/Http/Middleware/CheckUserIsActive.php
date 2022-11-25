<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $current_user = Auth::user();
        $users = User::with('roles')->get();

        foreach ($users as $user)
            if($current_user && $user->id == $current_user->id ){
                foreach ($user->roles as $role)
                    if ($role->id == '1'){
                        return $next($request);
                    } else {
                        return redirect(route('posts'))->with('status', 'Access Denied: You do have permission to access User Management');
                    }
            } else {
                return redirect(route('posts.index'))->with('status', 'Access Denied: You do have permission to access User Management');
            }

        //dd($users);

    }
}
