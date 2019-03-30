<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="/assets/css/ivy.css">
    <link rel="stylesheet" href="/assets/css/all.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.3/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.3/css/froala_style.min.css" rel="stylesheet" type="text/css" />
    
    <title>Writer Dashboard</title>
</head>
<body class="dashboard">

<div class="mobile_menu">
    
    <div class="row">
        <div class="container">
            <ul>
                <li class="close_menu">
                    <a href="#">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                </li>
                <li class="@if ($page == 'writer.dashboard') {{ 'selected' }} @endif"><a href="{{ route('writer.dashboard') }}">Dashboard</a></li>
                <li class="@if ($page == 'stories.index') {{ 'selected' }} @endif"><a href="{{ route('stories.index') }}">Stories</a></li>
                <li class="@if ($page == 'writer.profile') {{ 'selected' }} @endif"><a href="{{ route('writer.profile') }}">Settings</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>

</div>

<header>
    <div class="row navbar">
        <div class="container">
            <a class="menu_btn" href="#"><img src="/assets/img/black_menu.svg" alt="menu"></a>
            
            <ul>
                <li>
                    <a href="#"><img src="/assets/img/dashboard_logo.svg" alt="menu"></a>
                </li>
                <li class="@if ($page == 'writer.dashboard') {{ 'selected' }} @endif"><a href="{{ route('writer.dashboard') }}">Dashboard</a></li>
                <li class="@if ($page == 'stories.index') {{ 'selected' }} @endif"><a href="{{ route('stories.index') }}">Stories</a></li>
                <li class="@if ($page == 'writer.profile') {{ 'selected' }} @endif"><a href="{{ route('writer.profile') }}">Settings</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
    
    <div class="row intro">
        <div class="container">
            <h4>Welcome, {{ $writer->first_name }}.</h4>
            <p>It looks like you've already started writing a story, keep up the good work.</p>
        </div>
    </div>
    
    <div class="row story_btn">
        <div class="container">
            @if ($page == 'stories.edit')
                <ul>
                    <li>
                        <a href="{{ route('stories.publish', ['story' => $story]) }}">
                            {{ $story->published_at != null ? 'Unpublish' : 'Publish' }}
                        </a>
                    </li>
                    <li><a href="{{ route('stories.show', ['story' => $story->id]) }}">Preview</a></li>
                    <li class="delete"><a href="{{ route('stories.delete', ['story' => $story->id]) }}">Delete</a></li>
                </ul>
            @endif
            
            @if ($page == 'stories.index')
                <ul>
                    <li><a href="{{ route('stories.create') }}">New Story</a></li>
                </ul>
            @endif
        </div>
    </div>
</header>

@yield('content')

@include('partials.alert')

<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/scrollreveal.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.3/js/froala_editor.pkgd.min.js"></script>

<script>
    $(function() {
        $('#editor').froalaEditor({
            // Set the file upload URL.
            imageUploadURL: '/upload.php',
            
            imageUploadParams: {
                id: 'editor'
            }
        })
    });
</script>

<script src="/assets/js/main.js"></script>
</body>
</html>
