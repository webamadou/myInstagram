<?php

namespace App\Http\Controllers;

use App\Post;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        //dd($user->name) ;
        $followerCount = Cache::remember(
            'count.followers'.$user->id,
            now()->addSecond(30),
            function() use ($user){
                return $user->profile->followers->count();
            }
        );

        $followingCount = Cache::remember(
            'count.followings'.$user->id,
            now()->addSecond(30),
            function() use ($user){
                return $user->followings->count();
            }
        );
        return view('profiles.index', compact('user','followingCount','followerCount'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $follows = auth()->user() ? auth()->user()->followings->contains($user->id) : false;
        //$follows = auth()->user() ? true : false;
        $followerCount = Cache::remember(
            'count.followers'.$user->id,
            now()->addSecond(30),
            function() use ($user){
                return $user->profile->followers->count();
            }
        );

        $followingCount = Cache::remember(
            'count.followings'.$user->id,
            now()->addSecond(30),
            function() use ($user){
                return $user->followings->count();
            }
        );

        $posts = Post::find(['user_id'=>$user]);
        return view('profiles.index',compact('user','followerCount','followingCount','follows','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('profiles.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->validate([
            "description"   => ["string", "required","max:255"],
            "url"           => "url",
            "title"         => ["string"],
            "image"         => 'image|mimes:jpeg,png,gif,jpg'
        ]);
        if ($request->hasFile('image')){
            $imagePath  = $request->file('image');
            $thumbnail  = Image::make($imagePath);

            $imageName  = Str::slug($user->username).'.'.$imagePath->getClientOriginalExtension();
            $folder     = public_path().'/storage/profile/';
            $thumbnail->save($folder.$imageName);
            $thumbnail->fit(300);
            $thumbnail->save($folder.'thumbnail_'.$imageName);
            $data['image'] = $imageName;
        }
        $data['user_id'] = $user->id;
        if(is_null(auth()->user()->profile)){
            Profile::create($data);
        }

        $saved = $user->profile->update($data);
        return redirect()->route('profiles.index')->with(['status'=>'Modifications saved']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
