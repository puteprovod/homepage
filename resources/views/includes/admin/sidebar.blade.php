<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">Админ панель</li>
        <li class="nav-item">
            <a href="{{ route('admin.accounts.index') }}" class="nav-link">
                <i class="nav-icon fas fa-coins"></i>
                <p>
                    Счета
                    <span class="badge badge-info right"></span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.currencies.index') }}" class="nav-link">
                <i class="nav-icon fas fa-money-bill-wave"></i>
                <p>
                    Валюты
                    <span class="badge badge-info right"></span>
                </p>
            </a>
        </li>
    </ul>
</nav>
