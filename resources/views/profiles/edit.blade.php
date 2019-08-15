@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('profiles.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-2 offset-10">
                            <img src={{$user->profile->getThumbnail()}} alt="profile_image" class="w-100" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-6">
                            <textarea id="description"
                                   class="form-control @error('description') is-invalid @enderror"
                                      name="description">{{ old('description') ?? $user->profile->description}}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Url') }}</label>
                        <div class="col-md-6">
                            <input id="url"
                                   type="text"
                                   class="form-control @error('url') is-invalid @enderror"
                                   name="url"
                                   value="{{ old('url') ?? @$user->profile->url}}">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Profile Title') }}</label>
                        <div class="col-md-6">
                            <input id="title"
                                   type="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   name="title"
                                   value="{{ old('title') ?? @$user->profile->title}}"
                                   required autocomplete="title"
                                   autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>
                        <div class="col-md-8">
                            <input type="file" class="form-control-file" id="image" name="image">

                            @if ($errors->has('image'))
                                <strong>{{ $errors->first('image') }}</strong>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
