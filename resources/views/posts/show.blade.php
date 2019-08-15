@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="{{ $post->image }}" class="w-100">
                @can('edit-post', $post)
                    <br>
                    <div class="mt-3">
                        <a href="#" data-toggle="modal" onclick="deleteData({{$post->id}})" data-target="#DeleteModal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                @endcan
            </div>
            <div id="DeleteModal" class="modal fade text-danger" role="dialog">
                <div class="modal-dialog ">
                    <!-- Modal content-->
                    <form action={{route('posts.destroy',$post->id)}} id="deleteForm" method="post">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
                            </div>
                            <div class="modal-body">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <p class="text-center">{{__('Can you confirm the deletion of the post')}}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-4">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pr-3">
                            <img src="{{ $post->user->profile->getThumbnail() }}" class="rounded-circle w-100" style="max-width: 40px;">
                        </div>
                        <div>
                            <div class="font-weight-bold">
                                <a href={{ route('profiles.show',$post->user->id) }}>
                                    <span class="text-dark">{{ $post->user->username }}</span>
                                </a>
                                @can('folow-profile', $post->user->profile)
                                    <follow-button user-id={{$post->user->id}} follows={{@$follows}}></follow-button>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p>
                        <span class="font-weight-bold">
                            <a href="/profile/{{ $post->user->id }}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                        </span>
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @forelse($post->comments as $comment)
                        <div class="d-flex justify-content-between align-content-center">
                            <div class="avatar-wrapper col-2">
                                <a class="media-left" href={{route('profiles.show', $post->user->id)}}>
                                    <img src={{$comment->user->profile->getThumbnail()}} class="rounded-circle w-100">
                                </a>
                            </div>
                            <div class="media-body col-10">
                                <strong>{{$comment->user->username}}</strong>
                                {{$comment->commentary}}
                                <div class="comment-metas">
                                    <ul class="d-flex justify-content-between">
                                        <li><a href="#">29m</a></li>
                                        <li><a href="#">223 likes</a></li>
                                        <li><a href="#">Reply</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div></div>
                        @endforelse
                    </div>
                </div>

                <div class="add-comment">
                    <form action={{route('comments.store')}} method="post" class="form-group">
                        @csrf
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="hidden" name="post_id" value={{$post->id}}>
                                <input type="text" name="commentary" class="form-control mb-2" id="inlineFormInput" placeholder="Add a comment">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
