<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'The Saturation Point')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,700&display=swap" rel="stylesheet">
     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --ink-blue: #0f172a;       
            --paper-cream: #f8f5f2;    
            --gold-accent: #c6a87c;    
            --text-dark: #333333;
        }

        /* Base Body Font (Lato) */
        body {
            font-family: 'Lato', sans-serif;
            background-color: var(--paper-cream);
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Headings Font (Lora - Fixed aligned numbers) */
        h1, h2, h3, h4, h5, h6, .navbar-brand, .font-playfair {
            font-family: 'Lora', serif;
        }

        /* The rest remains the same */
        .navbar {
            background-color: var(--ink-blue);
            padding: 1rem 0;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: var(--gold-accent) !important;
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            font-weight: 400;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            transition: color 0.3s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--gold-accent) !important;
        }

        .btn-primary {
            background-color: var(--ink-blue);
            border-color: var(--ink-blue);
            border-radius: 2px;
            padding: 10px 25px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--gold-accent);
            border-color: var(--gold-accent);
            color: var(--ink-blue);
        }

        main { flex: 1; }

        footer {
            background-color: var(--ink-blue);
            color: white;
            padding: 3rem 0;
            margin-top: auto;
            border-top: 4px solid var(--gold-accent);
        }
        
        .footer-heading {
            color: var(--gold-accent);
            margin-bottom: 1.5rem;
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
            border-radius: 4px;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }

        .pagination .page-item .page-link {
            color: var(--ink-blue);
            border-radius: 2px !important;
            margin: 0 2px;
            border-color: #dee2e6;
            font-weight: 500;
        }
        .pagination .page-item.active .page-link {
            background-color: var(--ink-blue);
            border-color: var(--ink-blue);
            color: var(--gold-accent);
            font-weight: 700;
            z-index: 1;
        }

        .pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background-color: #e9ecef;
        }
        
        .pagination .page-item .page-link:hover {
            background-color: var(--paper-cream);
            border-color: var(--ink-blue);
        }
    </style>
</head>
<body>

    @include('partials.header')

    <main class="py-5">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>