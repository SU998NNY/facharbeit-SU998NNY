<div class="card mb-4">
    <a href="{{ url('posts/' . $post->id ) }}"><img class="card-img-top" src=" {{ $post->image }} " alt="..." /></a>
    <div class="card-body">
        <div class="small text-muted">{{ $post->created_at }}</div>
         <h2 class="card-title">{{ $post->title }}</h2>
         <p class="card-text">{{ $post->lead }}</p>
         <a class="btn btn-primary" href="{{ url('posts/' . $post->id ) }}">Read more →</a>
    </div>
</div>  