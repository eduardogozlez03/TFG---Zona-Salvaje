<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel Admin - Zona Salvaje</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/area_admin.css') }}">
    {{-- <script type="module" src="{{ asset('assets/js/area_admin.js') }}"></script> --}}


</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">

        <div class="sidebar-header">
            <p>Panel de Administración</p>
        </div>
        <nav class="sidebar-nav">
            <a href="#usuarios" class="active">
                <span class="icon"><i class="fas fa-users"></i></span>
                <span>Usuarios</span>
            </a>
            <a href="#clases">
                <span class="icon"><i class="fas fa-calendar-alt"></i></span>
                <span>Clases</span>
            </a>
        </nav>
    </div>

    <!-- Contenido principal -->
    <div class="main">
        <div class="page-header">

            <!-- Contenedor del logo -->
            <div class="admin-logo-container">
                <div class="admin-logo" onclick="window.location.href='{{ url('/') }}'">ZONA SALVAJE</div>
            </div>
            <h1>Panel de Control</h1>
            <a href="{{ url('/') }}" class="home-icon" title="Ir al inicio">
                <i class="fas fa-home"></i>
            </a>


        </div>

        <!-- Gestión de Usuarios -->
        <section id="usuarios" class="card">
            <div class="card-header">
                <h2><i class="fas fa-users"></i> Gestión de Usuarios</h2>
                <span class="badge">{{ $totalUsers }} Usuarios</span>
            </div>

            <!-- Controles de búsqueda y filtrado -->
            <div class="controls">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search-input" placeholder="Buscar usuarios...">
                </div>

                <div class="filter-group">
                    <label for="role-filter">Filtrar por:</label>
                    <select id="role-filter">
                        <option value="all">Todos los usuarios</option>
                        <option value="admin">Administradores</option>
                        <option value="vip">Usuarios VIP</option>
                        <option value="user">Usuarios básicos</option>
                    </select>
                </div>
            </div>

            <!-- Lista de usuarios -->
            <div class="user-list" id="user-list-container">
                @foreach ($users as $user)
                    <div class="user-card" data-user-id="{{ $user->id }}"
                        data-role="{{ $user->role == 'admin' ? 'admin' : ($user->subscription == 'vip' ? 'vip' : 'user') }}"
                        data-search="{{ strtolower($user->name . ' ' . $user->email) }}">
                        <div class="user-avatar">{{ substr($user->name, 0, 1) }}</div>
                        <div class="user-info">
                            <h3>{{ $user->name }}</h3>
                            <p>{{ $user->email }}</p>
                            @if ($user->subscription == 'vip')
                                <span class="vip-badge">VIP MEMBER</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Detalle de usuario (nuevo) -->
            <div class="user-detail-card" id="user-detail">
                <div class="user-detail-header">
                    <div class="user-detail-avatar" id="detail-avatar">U</div>
                    <div class="user-detail-info">
                        <h3 id="detail-name">Nombre Usuario</h3>
                        <p id="detail-email">email@ejemplo.com</p>
                        <span class="vip-badge" id="detail-badge" style="display: none;">VIP MEMBER</span>
                    </div>
                </div>

                <form id="user-edit-form" method="POST" action="">
                    @csrf
                    @method('PUT')

                    <div class="user-detail-meta">
                        <div class="meta-item">
                            <h4>Rol</h4>
                            <select name="role" class="form-control" id="detail-role">
                                <option value="user">Usuario Básico</option>
                                <option value="admin">Administrador</option>
                            </select>
                        </div>

                        <div class="meta-item">
                            <h4>Suscripción</h4>
                            <select name="subscription" class="form-control" id="detail-subscription">
                                <option value="Básico">Básico</option>
                                <option value="vip">VIP</option>
                            </select>
                        </div>

                        <div class="meta-item">
                            <h4>Fecha Registro</h4>
                            <p id="detail-created-at">01/01/2023</p>
                        </div>

                        <div class="meta-item">
                            <h4>Última Actualización</h4>
                            <p id="detail-updated-at">01/01/2023</p>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 2rem;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                        {{-- <button type="button" class="btn btn-danger" id="btn-delete-user">
                            <i class="fas fa-user-slash"></i> Dar de Baja
                        </button> --}}
                        <button type="button" class="btn btn-danger" id="btn-delete-user"
                            data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}">
                            <i class="fas fa-user-slash"></i> Dar de Baja
                        </button>

                    </div>
                </form>
            </div>

            <!-- Paginación -->
            <div class="pagination">
                {{ $users->links() }}
            </div>
        </section>

        <!-- Gestión de Clases -->
        <section id="clases" class="card">
            <div class="card-header">
                <h2><i class="fas fa-calendar-alt"></i> Gestión de Clases</h2>
                <span class="badge">{{ count($clases) }} Clases</span>
            </div>

            <!-- Nuevo buscador de clases -->
            <div class="controls">
                <div class="search-box class-search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="class-search-input" placeholder="Buscar clases...">
                </div>

                <div class="filter-group">
                    <label for="instructor-filter">Instructor:</label>
                    <select id="instructor-filter">
                        <option value="all">Todos</option>
                        @foreach ($admins as $admin)
                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Lista de clases -->
            <div id="class-list-container">
                @foreach ($clases as $clase)
                    <form method="POST" action="{{ route('admin.class.update', $clase->id) }}" class="class-form"
                        data-search="{{ strtolower($clase->name . ' ' . $clase->instructor->name) }}"
                        data-instructor="{{ $clase->admin_id }}">
                        @csrf
                        @method('PUT')

                        <h3><i class="fas fa-dumbbell"></i> {{ $clase->name }}</h3>

                        <div class="form-group">
                            <label>Instructor:</label>
                            <select name="admin_id" class="form-control">
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}"
                                        @if ($admin->id == $clase->admin_id) selected @endif>
                                        {{ $admin->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Fecha:</label>
                            <input type="date" name="class_date" class="form-control"
                                value="{{ \Carbon\Carbon::parse($clase->class_date)->format('Y-m-d') }}">
                        </div>

                        <div class="form-group">
                            <label>Capacidad:</label>
                            <input type="number" name="capacity" class="form-control"
                                value="{{ $clase->capacity }}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                            <button type="button" class="btn btn-danger btn-delete-class"
                                data-class-id="{{ $clase->id }}" data-class-name="{{ $clase->name }}">
                                <i class="fas fa-trash"></i> Eliminar Clase
                            </button>
                        </div>
                    </form>
                @endforeach
            </div>

            <!-- Botón para añadir nueva clase -->
            <div class="form-group">
                <button type="button" class="btn btn-primary" id="add-class-btn">
                    <i class="fas fa-plus"></i> Añadir Nueva Clase
                </button>
            </div>
        </section>
    </div>

    <!-- Modal de confirmación para usuarios -->
    <div class="modal" id="confirm-user-modal">
        <div class="modal-content">
            <h3 id="modal-user-message">¿Estás seguro de dar de baja a este usuario?</h3>
            <div class="modal-actions">
                <button class="btn btn-cancel" id="cancel-user-btn">Cancelar</button>
                <button class="btn btn-danger" id="confirm-user-btn">Confirmar</button>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación para clases -->
    <div class="modal" id="confirm-class-modal">
        <div class="modal-content">
            <h3 id="modal-class-message">¿Estás seguro de eliminar esta clase?</h3>
            <div class="modal-actions">
                <button class="btn btn-cancel" id="cancel-class-btn">Cancelar</button>
                <button class="btn btn-danger" id="confirm-class-btn">Confirmar</button>
            </div>
        </div>
    </div>

    <!-- Modal para añadir nueva clase -->
    <div class="modal" id="add-class-modal">
        <div class="modal-content">
            <h3><i class="fas fa-plus-circle"></i> Añadir Nueva Clase</h3>
            <form id="new-class-form" method="POST" action="{{ route('admin.class.store') }}">
                @csrf
                <div class="form-group">
                    <label>Nombre de la clase:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Instructor:</label>
                    <select name="admin_id" class="form-control" required>
                        @foreach ($admins as $admin)
                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Fecha:</label>
                    <input type="date" name="class_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Capacidad:</label>
                    <input type="number" name="capacity" class="form-control" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-cancel" id="cancel-add-class">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Clase</button>
                </div>
            </form>
        </div>
    </div>

    <div id="toast-success" class="toast-success">Usuario actualizado correctamente</div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const BASE_PATH = '/gonzaleze/backend_2'; // ✅ Añade tu subdirectorio base

        // 1️⃣ Filtrado y búsqueda de usuarios
        const searchInput = document.getElementById('search-input');
        const roleFilter = document.getElementById('role-filter');
        const userCards = document.querySelectorAll('.user-card');

        function filterUsers() {
            const searchTerm = searchInput.value.toLowerCase();
            const roleValue = roleFilter.value;

            userCards.forEach(card => {
                const matchesSearch = card.dataset.search.includes(searchTerm);
                const matchesRole = roleValue === 'all' || card.dataset.role === roleValue;

                card.style.display = (matchesSearch && matchesRole) ? 'flex' : 'none';
            });
        }

        searchInput.addEventListener('input', filterUsers);
        roleFilter.addEventListener('change', filterUsers);

        // 2️⃣ Modal para eliminar usuario
        const userModal = document.getElementById('confirm-user-modal');
        const deleteUserButtons = document.querySelectorAll('.btn-delete-user');
        const deleteUserBtn = document.getElementById('btn-delete-user');
        let currentUserId = null;

        deleteUserButtons.forEach(button => {
            button.addEventListener('click', function () {
                currentUserId = this.dataset.userId;
                const userName = this.dataset.userName;
                document.getElementById('modal-user-message').textContent =
                    `¿Estás seguro de dar de baja a ${userName}? Esta acción no se puede deshacer.`;
                userModal.style.display = 'flex';
            });
        });

        document.getElementById('cancel-user-btn').addEventListener('click', function () {
            userModal.style.display = 'none';
        });

        document.getElementById('confirm-user-btn').addEventListener('click', function () {
            if (currentUserId) {
                fetch(`${BASE_PATH}/admin/users/${currentUserId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast('Usuario eliminado correctamente');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showToast('Error al eliminar usuario', '#e74c3c');
                    }
                })
                .catch(() => {
                    showToast('Error al eliminar usuario', '#e74c3c');
                });

                userModal.style.display = 'none';
            }
        });

        // 3️⃣ Modal para eliminar clase
        const classModal = document.getElementById('confirm-class-modal');
        const deleteClassButtons = document.querySelectorAll('.btn-delete-class');
        let currentClassId = null;

        deleteClassButtons.forEach(button => {
            button.addEventListener('click', function () {
                currentClassId = this.dataset.classId;
                const className = this.dataset.className;
                document.getElementById('modal-class-message').textContent =
                    `¿Estás seguro de eliminar la clase "${className}"? Todos los registros asociados se perderán.`;
                classModal.style.display = 'flex';
            });
        });

        document.getElementById('cancel-class-btn').addEventListener('click', function () {
            classModal.style.display = 'none';
        });

        document.getElementById('confirm-class-btn').addEventListener('click', function () {
            if (currentClassId) {
                fetch(`${BASE_PATH}/admin/classes/${currentClassId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    }
                });
            }
            classModal.style.display = 'none';
        });

        // 4️⃣ Modal para añadir clase
        const addClassModal = document.getElementById('add-class-modal');
        const addClassBtn = document.getElementById('add-class-btn');
        const cancelAddClassBtn = document.getElementById('cancel-add-class');

        addClassBtn.addEventListener('click', function () {
            addClassModal.style.display = 'flex';
        });

        cancelAddClassBtn.addEventListener('click', function () {
            addClassModal.style.display = 'none';
        });

        // Cerrar modales al hacer clic fuera
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });

        // Sidebar navegación
        const currentHash = window.location.hash || '#usuarios';
        document.querySelectorAll('.sidebar-nav a').forEach(link => {
            if (link.getAttribute('href') === currentHash) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

        document.querySelectorAll('.sidebar-nav a').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const target = this.getAttribute('href');
                window.location.hash = target;

                document.querySelectorAll('.sidebar-nav a').forEach(a => a.classList.remove('active'));
                this.classList.add('active');

                document.querySelectorAll('section').forEach(section => {
                    section.style.display = 'none';
                });

                document.querySelector(target).style.display = 'block';
            });
        });

        if (currentHash) {
            document.querySelectorAll('section').forEach(section => {
                section.style.display = 'none';
            });
            document.querySelector(currentHash).style.display = 'block';
        }

        // Filtrado de clases
        const classSearchInput = document.getElementById('class-search-input');
        const instructorFilter = document.getElementById('instructor-filter');
        const classForms = document.querySelectorAll('.class-form');

        function filterClasses() {
            const searchTerm = classSearchInput.value.toLowerCase();
            const instructorId = instructorFilter.value;

            classForms.forEach(form => {
                const matchesSearch = form.dataset.search.includes(searchTerm);
                const matchesInstructor = instructorId === 'all' || form.dataset.instructor === instructorId;

                form.style.display = (matchesSearch && matchesInstructor) ? 'block' : 'none';
            });
        }

        classSearchInput.addEventListener('input', filterClasses);
        instructorFilter.addEventListener('change', filterClasses);

        // Mostrar detalle de usuario
        const userDetailCard = document.getElementById('user-detail');
        userCards.forEach(card => {
            card.addEventListener('click', function () {
                const userId = this.dataset.userId;
                currentUserId = userId;

                fetch(`${BASE_PATH}/admin/users/${userId}`)
                    .then(response => response.json())
                    .then(data => {
                        const userData = data.user;

                        document.getElementById('detail-avatar').textContent = userData.name.charAt(0);
                        document.getElementById('detail-name').textContent = userData.name;
                        document.getElementById('detail-email').textContent = userData.email;
                        document.getElementById('detail-role').value = userData.role;
                        document.getElementById('detail-subscription').value = userData.subscription;

                        const createdAt = new Date(userData.created_at).toLocaleDateString('es-ES');
                        const updatedAt = new Date(userData.updated_at).toLocaleDateString('es-ES');

                        document.getElementById('detail-created-at').textContent = createdAt;
                        document.getElementById('detail-updated-at').textContent = updatedAt;

                        const vipBadge = document.getElementById('detail-badge');
                        vipBadge.style.display = userData.subscription === 'vip' ? 'inline-block' : 'none';

                        document.getElementById('user-edit-form').action = `${BASE_PATH}/admin/users/${userId}`;
                        userDetailCard.classList.add('show');
                        userDetailCard.scrollIntoView({ behavior: 'smooth' });

                        deleteUserBtn.setAttribute('data-user-id', userData.id);
                        deleteUserBtn.setAttribute('data-user-name', userData.name);
                        deleteUserBtn.onclick = function () {
                            currentUserId = this.getAttribute('data-user-id');
                            const userName = this.getAttribute('data-user-name');
                            if (currentUserId) {
                                document.getElementById('modal-user-message').textContent =
                                    `¿Estás seguro de dar de baja a ${userName}? Esta acción no se puede deshacer.`;
                                userModal.style.display = 'flex';
                            }
                        };
                    })
                    .catch(error => {
                        console.error('Error al cargar el usuario:', error);
                    });
            });
        });

        // Enviar formulario de edición de usuario
        document.getElementById('user-edit-form').addEventListener('submit', function (e) {
            e.preventDefault();

            fetch(this.action, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    role: document.getElementById('detail-role').value,
                    subscription: document.getElementById('detail-subscription').value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Usuario actualizado correctamente');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function showToast(message, bgColor = '#207E27') {
            const toast = document.getElementById('toast-success');
            toast.textContent = message;
            toast.style.backgroundColor = bgColor;

            toast.classList.add('show');

            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
    });
</script>




</body>

</html>
