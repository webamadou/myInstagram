@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 p-5">
                <img src={{ $user->profile->image }} alt="default-avatar" class="w-100 rounded-circle">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h4">{{$user->username}}</div>

                        @can('follow-profile',$user->profile)
                            <follow-button user-id={{$user->id}} follows={{$follows}}></follow-button>
                        @endcan
                    </div>
                    @cannot('follow-profile', $user->profile)
                        <a href={{ route('posts.create') }}>Add New Post</a>
                    @endcannot
                </div>

                {{--@can('update', $user->profile)
                    <a href="#">Edit Profile</a>
                @endcan--}}

                <div class="d-flex">
                    <div class="pr-5"><strong>123</strong> posts</div>
                    <div class="pr-5"><strong>{{$followingCount}}</strong> following</div>
                    <div class="pr-5"><strong>{{$followerCount}}</strong> followers</div>
                </div>
                <div class="pt-4 font-weight-bold">{{$user->profile->username}}</div>
                <div>{{$user->profile->description}}</div>
                <div><a href={{$user->profile->url}}>{{$user->profile->url}}</a></div>
            </div>
        </div>

        <div class="row pt-5">
            @forelse($user->posts as $post)
                <div class="col-4 pb-4">
                    <a href={{ route('posts.show',$post->id)}}>
                        <img src={{ $post->thumbnail() }} class="w-100">
                    </a>
                </div>
            @empty
                <h1 class="text-center text-black-50">{{__('No Post')}}</h1>
            @endforelse
        </div>
    </div>
@endsection
