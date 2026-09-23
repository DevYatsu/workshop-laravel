{{-- @var \Illuminate\Support\ViewErrorBag $errors --}}
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'Bibliothèque')</title>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css"
            rel="stylesheet"
        />

        {{--
            Theme: HE-Arc red (#e30613), white surfaces, black text.
            Everything else is Bootstrap 5 defaults. Only the red accents
            and the hooks Bootstrap has no utility for live here.
        --}}
        <style>
            :root {
                --he-red: #e30613;
                --he-red-dark: #a80510;
                --bs-link-color: var(--he-red);
                --bs-link-hover-color: var(--he-red-dark);
                --bs-link-color-rgb: 227, 6, 19;
                --bs-link-hover-color-rgb: 168, 5, 16;
            }

            body {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            main {
                flex: 1 0 auto;
            }

            .navbar-library {
                background-color: #1a1a1a;
                border-bottom: 3px solid var(--he-red);
            }

            .navbar-library .nav-link.active {
                background-color: var(--he-red);
                color: #fff;
            }

            .btn-primary {
                --bs-btn-bg: var(--he-red);
                --bs-btn-border-color: var(--he-red);
                --bs-btn-hover-bg: var(--he-red-dark);
                --bs-btn-hover-border-color: var(--he-red-dark);
                --bs-btn-active-bg: var(--he-red-dark);
                --bs-btn-active-border-color: var(--he-red-dark);
                --bs-btn-disabled-bg: var(--he-red);
                --bs-btn-disabled-border-color: var(--he-red);
            }

            .btn-outline-primary {
                --bs-btn-color: var(--he-red);
                --bs-btn-border-color: var(--he-red);
                --bs-btn-hover-bg: var(--he-red);
                --bs-btn-hover-border-color: var(--he-red);
                --bs-btn-active-bg: var(--he-red-dark);
                --bs-btn-active-border-color: var(--he-red-dark);
            }

            .form-control:focus,
            .form-select:focus {
                border-color: var(--he-red);
                box-shadow: 0 0 0 0.2rem rgba(227, 6, 19, 0.15);
            }

            .pagination {
                --bs-pagination-active-bg: var(--he-red);
                --bs-pagination-active-border-color: var(--he-red);
            }

            .alert-warning {
                --bs-alert-color: #8a030b;
                --bs-alert-bg: #fdeaec;
                --bs-alert-border-color: #f6c9ce;
                --bs-alert-link-color: #8a030b;
            }

            .badge-stock-out {
                background-color: #1a1a1a;
                color: #fff;
            }

            .badge-stock-low {
                background-color: transparent;
                color: var(--he-red-dark);
                border: 1px solid var(--he-red-dark);
            }

            .badge-stock-ok,
            .badge-neutral {
                background-color: #f8f9fa;
                color: #5c5c5c;
                border: 1px solid #e0e0e0;
            }

            .text-accent,
            .icon-accent {
                color: var(--he-red) !important;
            }
        </style>
    </head>
    <body>
        <nav
            class="navbar navbar-expand-lg navbar-library sticky-top"
            data-bs-theme="dark"
        >
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="bi bi-book-half me-1" aria-hidden="true"></i>
                    Bibliothèque
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Basculer la navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a
                                class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                href="{{ route('home') }}"
                                @if (request()->routeIs('home')) aria-current="page" @endif
                            >
                                <i class="bi bi-house-door me-1" aria-hidden="true"></i>
                                Accueil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link {{ request()->routeIs('books.*') && ! request()->routeIs('books.order') ? 'active' : '' }}"
                                href="{{ route('books.index') }}"
                                @if (request()->routeIs('books.*') && ! request()->routeIs('books.order')) aria-current="page" @endif
                            >
                                <i class="bi bi-journal-text me-1" aria-hidden="true"></i>
                                Livres
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link {{ request()->routeIs('books.order') ? 'active' : '' }}"
                                href="{{ route('books.order') }}"
                                @if (request()->routeIs('books.order')) aria-current="page" @endif
                            >Order</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}"
                                href="{{ route('orders.index') }}"
                                @if (request()->routeIs('orders.*')) aria-current="page" @endif
                            >
                                <i class="bi bi-truck me-1" aria-hidden="true"></i>
                                Commandes
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container py-4 d-flex flex-column">
            {{-- Flash messages and validation errors are siblings of the
                 yielded content, never concatenated onto the same line. --}}
            @if (session('success'))
                <div
                    class="alert alert-success alert-dismissible fade show d-flex align-items-start"
                    role="alert"
                >
                    <i class="bi bi-check-circle-fill me-2 mt-1" aria-hidden="true"></i>
                    <div>{{ session('success') }}</div>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Fermer"
                    ></button>
                </div>
            @endif

            @if (session('error'))
                <div
                    class="alert alert-danger alert-dismissible fade show d-flex align-items-start"
                    role="alert"
                >
                    <i class="bi bi-exclamation-triangle-fill me-2 mt-1" aria-hidden="true"></i>
                    <div>{{ session('error') }}</div>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Fermer"
                    ></button>
                </div>
            @endif

            @if (isset($errors) && $errors->any())
                <div
                    class="alert alert-danger alert-dismissible fade show"
                    role="alert"
                >
                    <div class="d-flex align-items-start">
                        <i
                            class="bi bi-exclamation-octagon-fill me-2 mt-1"
                            aria-hidden="true"
                        ></i>
                        <div>
                            <strong>Le formulaire contient des erreurs.</strong>
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Fermer"
                    ></button>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="border-top text-secondary small py-3 mt-4">
            <div class="container d-flex flex-wrap justify-content-between gap-2">
                <span>Atelier Laravel</span>
                <span>Bootstrap 5.3</span>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        {{--
            One delegated handler backs every destructive action. Forms declare
            data-confirm="…" and the title lives in an attribute, never in a JS
            string literal, so quotes or newlines in a book title cannot break
            the script. Without JS the form still submits — confirmation is an
            enhancement, not a requirement.
        --}}
        <script>
            document.addEventListener('submit', function (event) {
                var message = event.target.getAttribute('data-confirm');

                if (message && !window.confirm(message)) {
                    event.preventDefault();
                }
            });
        </script>
    </body>
</html>
