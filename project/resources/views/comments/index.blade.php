<div class="page-header-wrapper">
    <h2>Comments</h2>
</div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            Comments
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @foreach ($comments->reverse() as $comment)
                <li>
                    <a href="/comments/{{ $comment->id }}">{{ $comment->title }}</a>
                </li>
            @endforeach
        </div>
    </div>
