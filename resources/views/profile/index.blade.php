@extends('layouts.front')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        @if (!is_null($headline))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="caption mx-auto">
                                </div>
                                <div class="name p-2">
                                    <h1>{{ str_limit($headline->name, 70) }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="name p-2">
                                    <h10>{{ str_limit($headline->gender, 70) }}</h10>
                                </div>
                            </div>
                        </div>
                            <div class="name p-2">
                            <h10>{{ str_limit($headline->hobby, 70) }}</h10>
                        
                        <div class="col-md-6">
                            <p class="introduction mx-auto">{{ str_limit($headline->introduction, 650) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="title">
                                    {{ str_limit($post->title, 150) }}
                                </div>
                                <div class="body mt-3">
                                    {{ str_limit($post->body, 1500) }}
                                </div>
                            </div>
                            <div class="image col-md-6 text-right mt-4">
                                @if ($post->image_path)
                                    <img src="{{ asset('storage/image/' . $post->image_path) }}">
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection