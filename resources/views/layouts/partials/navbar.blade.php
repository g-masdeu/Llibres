<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<script src="https://cdn.lordicon.com/lordicon.js"></script>

<style>
    .navbar-custom {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 12px rgba(118, 75, 162, 0.1);
        border-bottom: 2px solid #e2d4f0;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        font-weight: bold;
        font-size: 1.3rem;
        color: #764ba2 !important;
    }

    .navbar-brand lord-icon {
        margin-right: 0.5rem;
    }

    .nav-link,
    .dropdown-item {
        color: #4b368c !important;
        transition: color 0.2s ease;
    }

    .nav-link:hover,
    .dropdown-item:hover {
        color: #a566c4 !important;
    }

    .form-inline input {
        border-radius: 50px;
        border: 1px solid #cbb3e8;
        padding: 0.4rem 1rem;
    }

    .form-inline button {
        border-radius: 50px;
        background: linear-gradient(135deg, #9d50bb, #6e48aa);
        color: white;
        border: none;
        padding: 0.4rem 1rem;
        margin-left: 0.5rem;
        transition: background 0.3s ease;
    }

    .form-inline button:hover {
        background: linear-gradient(135deg, #b87fda, #9060c6);
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('books.index') }}">
            <lord-icon src="{{ asset('icons/book.json') }}" trigger="hover" colors="primary:#764ba2,secondary:#c084fc"
                style="width:35px;height:35px">
            </lord-icon>
            Valoració de llibres
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @auth
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto">
                    @if (auth()->user()->is_admin)
                        <!-- ADMIN OPTIONS -->
                        @foreach (['Llibres' => 'books', 'Categories' => 'categories', 'Usuaris' => 'users'] as $name => $route)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown{{ $name }}"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Editar {{ $name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdown{{ $name }}">
                                    <a class="dropdown-item" href="{{ url("/$route") }}">Llista</a>
                                    <a class="dropdown-item" href="{{ url("/$route/create") }}">Afegir</a>
                                    <a class="dropdown-item" href="{{ url("/$route/delete") }}">Eliminar</a>
                                </div>
                            </li>
                        @endforeach
                    @endif

                    <!-- Categories públics -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownCategoriesPublic" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownCategoriesPublic">
                            @foreach ($categories as $category)
                                <a class="dropdown-item" href="{{ route('books.category', $category->id) }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                </ul>

                <!-- Buscador -->
                <form class="form-inline position-relative mx-3" id="book-search-form" autocomplete="off"
                    style="z-index: 1030;">
                    <input class="form-control rounded-pill px-3" id="book-search" type="search"
                        placeholder="Cercar llibres..." aria-label="Search" style="width: 250px;">
                </form>
                <div id="search-results" class="list-group position-absolute w-100 mt-1 bg-white border rounded shadow"
                    style="top: 100%;"></div>




                <!-- Perfil -->
                <ul class="navbar-nav ml-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ url('/profile/edit') }}">Perfil</a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ url('/logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" type="submit">Tancar Sessió</button>
                            </form>
                        </div>
                    </li>
                </ul>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const searchInput = document.getElementById('book-search');
                        const resultsBox = document.getElementById('search-results');

                        let timeout = null;

                        searchInput.addEventListener('input', function() {
                            const query = this.value.trim();

                            clearTimeout(timeout);
                            resultsBox.innerHTML = '';
                            if (query.length < 2) return;

                            timeout = setTimeout(() => {
                                fetch(`/search-books?query=${encodeURIComponent(query)}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log(data); // DEBUG: veure què arriba
                                        resultsBox.innerHTML = '';

                                        if (!data.length) {
                                            resultsBox.innerHTML =
                                                `<div class="list-group-item disabled">Cap resultat trobat</div>`;
                                            return;
                                        }

                                        data.forEach(book => {
                                            const item = document.createElement('a');
                                            item.href = `/books/${book.id}`;
                                            item.className =
                                                'list-group-item list-group-item-action d-flex align-items-center';
                                            img.classList.add('rounded', 'mr-2');


                                            const img = document.createElement('img');
                                            img.src = book.image;
                                            img.alt = book.title;
                                            img.style.width = '35px';
                                            img.style.height = '50px';
                                            img.style.objectFit = 'cover';
                                            img.classList.add('rounded', 'mr-2');

                                            const text = document.createElement('div');
                                            text.innerHTML =
                                                `<strong>${book.title}</strong><br><small>${book.author}</small>`;

                                            item.appendChild(img);
                                            item.appendChild(text);
                                            resultsBox.appendChild(item);
                                        });
                                    })
                                    .catch(error => {
                                        console.error('Error en la cerca:', error);
                                    });
                            }, 300);
                        });

                        document.addEventListener('click', function(e) {
                            if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
                                resultsBox.innerHTML = '';
                            }
                        });
                    });
                </script>


            </div>
        @endauth
    </div>
</nav>
