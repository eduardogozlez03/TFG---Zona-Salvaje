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
    <script type="module" src="{{ asset('assets/js/area_admin.js') }}" ></script>


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
                <div class="admin-logo" onclick="window.location.href='/'">ZONA SALVAJE</div>
            </div>
            <h1>Panel de Control</h1>
            <a href="/" class="home-icon" title="Ir al inicio">
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




</body>

</html>
