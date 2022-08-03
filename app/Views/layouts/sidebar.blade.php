<nav role="navigation" class="widget-body">
    <ul class="acc-menu">
        <li><a href="{{ base_url }}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
        <li><a href="javascript:void();"><i class="fa fa-database"></i><span>Master Data</span></a>
            <ul class="acc-menu">
                <li><a href="{{ base_url }}bahan">Bahan</a></li>
                <li><a href="{{ base_url }}meja">Meja</a></li>
            </ul>
        </li>
        <li><a href="javascript:void();"><i class="fa fa-lock"></i><span>User Management</span></a>
            <ul class="acc-menu">
                <li><a href="{{ base_url }}user">User</a></li>
                <li><a href="{{ base_url }}role">Role</a></li>
            </ul>
        </li>
    </ul>
</nav>
