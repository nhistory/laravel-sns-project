<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('check.theme.manager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $themes = Theme::all();
        $users = User::with('roles')->get();
        return view('themes.index', compact(['themes','users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $users = User::with('roles')->get();
        return view('themes.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'name' => ['required','unique:themes,name', 'max:50'],
            'cdn_url' => ['required','unique:themes,cdn_url', 'max:255', 'url']
        ]);

        //save
        $theme = new Theme;
        $theme->name = $request->name;
        $theme->cdn_url = $request->cdn_url;
        $theme->created_by = Auth::user()->id; //currently logged in user
        $theme->save();

        //redirect to the list
        return redirect(route('themes.index'))->with('status', 'Theme Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function show(Theme $theme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Theme $theme)
    {
        $users = User::with('roles')->get();
        return view('themes.edit', compact(['theme','users']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Theme $theme)
    {
        //validate
        $request->validate([
            'name' => ['required','unique:themes,name,' . $theme->id, 'max:50'],
            'cdn_url' => ['required','unique:themes,cdn_url,' . $theme->id, 'max:255', 'url']
        ]);

        //save changes
        $theme->name = $request->name;
        $theme->cdn_url = $request->cdn_url;
        $theme->updated_by = Auth::user()->id;
        $theme->save();

        //redirect lists
        return redirect(route('themes.index'))->with('status', 'Theme Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Theme $theme)
    {
        $theme->delete(); //not a soft delete

        return redirect(route('themes.index'))->with('status','Theme Deleted');
    }
}
