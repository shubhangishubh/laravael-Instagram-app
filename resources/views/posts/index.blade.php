@extends('layouts.app')

@section('content')
{{-- Posts Form --}}

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mx-auto my-5" style="width: 32rem;">
                <div class="card-body">
                    <form method="post" action="{{route('posts')}}" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control  @error('body') border-danger @enderror " id="body"
                                name="body" rows="3" placeholder="Post something!"></textarea>
                            @error('body')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </form>

                    @if ($posts->count())
                    @foreach ($posts as $post)
                    <div class="mb-4">
                        <a href="{{route('users.posts',$post->user)}}"
                            class="fw-bold text-decoration-none text-dark">{{$post->user->name}}</a><span
                            class="text-secondary">
                            {{$post->created_at->diffForHumans()}}</span>
                        <p class="mb-2">{{$post->body}}</p>
                        <div class="d-inline-flex">
                            @auth
                            @if (!$post->likedBy(auth()->user()))
                            <form action="{{route('posts.likes',$post)}}" method="post" class="mr-1">
                                @csrf
                                <button type="submit" class="text-info btn ">Like</button>
                            </form>
                            @else
                            <form action="{{route('posts.likes',$post)}}" method="post" class="mr-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-info btn ">Unlike</button>
                            </form>
                            @endif
                            @endauth
                            <span class="mt-2"> {{$post->likes->count()}}
                                {{ Str::plural('like',$post->likes->count() )}} </span>
                            @can('delete', $post)
                            <form action="{{ route('post.destroy', $post) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-info btn pt-2">Delete</button>
                            </form>
                            @endcan
                        </div>
                    </div>
                    @endforeach
                    {{ $posts->links() }}
                    @else
                    <p>There are no posts</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
