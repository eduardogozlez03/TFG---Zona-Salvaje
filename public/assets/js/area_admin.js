document.addEventListener('DOMContentLoaded', function() {

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
    const deleteUserBtn = document.getElementById('btn-delete-user'); // botón del detalle
    let currentUserId = null;

    // botones de la lista
    deleteUserButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentUserId = this.dataset.userId;
            const userName = this.dataset.userName;
            document.getElementById('modal-user-message').textContent =
                `¿Estás seguro de dar de baja a ${userName}? Esta acción no se puede deshacer.`;
            userModal.style.display = 'flex';
        });
    });

    document.getElementById('cancel-user-btn').addEventListener('click', function() {
        userModal.style.display = 'none';
    });

    document.getElementById('confirm-user-btn').addEventListener('click', function() {
        if (currentUserId) {
            fetch(`/admin/users/${currentUserId}`, {
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
        button.addEventListener('click', function() {
            currentClassId = this.dataset.classId;
            const className = this.dataset.className;
            document.getElementById('modal-class-message').textContent =
                `¿Estás seguro de eliminar la clase "${className}"? Todos los registros asociados se perderán.`;
            classModal.style.display = 'flex';
        });
    });

    document.getElementById('cancel-class-btn').addEventListener('click', function() {
        classModal.style.display = 'none';
    });

    document.getElementById('confirm-class-btn').addEventListener('click', function() {
        if (currentClassId) {
            fetch(`/admin/classes/${currentClassId}`, {
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

    addClassBtn.addEventListener('click', function() {
        addClassModal.style.display = 'flex';
    });

    cancelAddClassBtn.addEventListener('click', function() {
        addClassModal.style.display = 'none';
    });

    // Cerrar modales al hacer clic fuera
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', function(e) {
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
        link.addEventListener('click', function(e) {
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
        card.addEventListener('click', function() {
            const userId = this.dataset.userId;
            currentUserId = userId;

            fetch(`/admin/users/${userId}`)
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

                    document.getElementById('user-edit-form').action = `/admin/users/${userId}`;
                    userDetailCard.classList.add('show');
                    userDetailCard.scrollIntoView({ behavior: 'smooth' });

                    // actualizar botón "Dar de baja" → muy importante
                    deleteUserBtn.setAttribute('data-user-id', userData.id);
                    deleteUserBtn.setAttribute('data-user-name', userData.name);

                    // actualizar el evento del botón del detalle:
                    deleteUserBtn.onclick = function() {
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
    document.getElementById('user-edit-form').addEventListener('submit', function(e) {
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
