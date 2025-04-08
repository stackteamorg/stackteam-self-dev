
<meta charset="UTF-8">
<x-meta name="csrf-token" :content="csrf_token()" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<x-meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<x-meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
<link rel="canonical" href="{{ $url }}" />
@if(!empty($title))
    <title>{{ $title }}</title>
@endif

<x-meta name="description" :content="$description" />

<meta name="author" content="{{ $author }}" />

<x-meta og="locale" :content="$locale" />
<x-meta og="type" :content="$type" />
<x-meta og="title" :content="$title" />
<x-meta og="description" :content="$description" />
<x-meta og="url" :content="$url" />
<x-meta og="site_name" content="استک تیم" />
<x-meta og="image" :content="$image" />
<x-meta og="image:type" :content="$image" />

<x-meta article="published_time" :content="$published_time" />
<x-meta article="modified_time" :content="$modified_time" />

<x-meta twitter="card" content="summary_large_image" />
<x-meta twitter="title" :content="$title" />
<x-meta twitter="description" :content="$description" />
<x-meta twitter="image" :content="$image" />
<x-meta twitter="image:alt" :content="$title" />
<x-meta twitter="creator" content="@mahdihomeyli" />
<x-meta twitter="site" content="@stackteam_org" />