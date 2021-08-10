
<div class="mb-4">
    <a href="{{route('users.posts',$post->user)}}"
        class="fw-bold text-decoration-none text-dark">{{$post->user->name}}</a><span class="text-secondary">
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
        <span class="mt-2"> {{$post->likes->count()}} {{ Str::plural('like',$post->likes->count() )}} </span>

        @can('delete', $post)
        <form action="{{ route('post.destroy', $post) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-info btn pt-2">Delete</button>
        </form>
        @endcan
    </div>
</div>
