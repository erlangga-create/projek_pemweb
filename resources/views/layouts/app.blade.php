<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'NyaperGO')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body { margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; }

        /* Simple styles for flash messages */
        .flash-message {
            max-width: 1000px;
            margin: 16px auto;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: 600;
            box-sizing: border-box;
            max-width: 1000px;
        }
        .flash-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .flash-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }
        .flash-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
    @stack('styles')
</head>
<body>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="flash-message flash-success">
            <i class="fa fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('warning'))
        <div class="flash-message flash-warning">
            <i class="fa fa-exclamation-triangle"></i> {{ session('warning') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flash-message flash-error">
            <i class="fa fa-times-circle"></i> {{ session('error') }}
        </div>
    @endif

    @yield('content')

    @stack('scripts')
</body>
</html>
