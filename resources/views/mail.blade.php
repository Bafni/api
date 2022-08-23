@component('mail::message')
    <p> Post Id {{ $post->id }} </p>

    <p> Post Title {{ $post->title }}</p>
    <p> Post Content {{ $post->content }}</p>

@endcomponent
