@extends('layouts.app')

@section('content')

<h1 class="text-center mt-5"> Hello {{ $user->name }}</h1>
    <div class="d-grid gap-2 d-md-flex justify-content-md-center mb-2">
        <button class="btn btn-primary" type="button">Follow</button>
      </div>
    {{-- <form action="{{route('posts.likes',$post)}}" method="post" class="mr-1">
        @csrf

    </form> --}}

<div class="card container">
    <div class="card-body">
        @if ($posts->count())
        @foreach ($posts as $post)
        <div class="mb-4">
            <p class="m-0 p-0">{{$post->body}}</p>
            <span class="text-secondary">{{$post->created_at->diffForHumans()}}</span><br>
            <div class="d-inline-flex">
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
@endsection