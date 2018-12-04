<h1>Blog</h1>

@foreach ($data as $post)
    <article>
        <h1 id="post{{$post->id}}">{{$post->title }}</h1>
        <a href="blog/edit/{{$post->id}} ">编辑</a>
        <a href="blog/delete/{{$post->id}}">删除</a>
        <p>
            {{$post->text}}
        </p>
    </article>
@endforeach