@php
use App\Core\Request;
use App\Models\Role;

$request = new Request();
$role = new Role();

$get_role = $role->find(['id' => $request->sess('role_id')]);
$get_role = $get_role->fetch_assoc();
@endphp
<nav role="navigation" class="widget-body">
    {{-- Is admin --}}
    @if ($get_role['nama'] == 'Admin')
        <ul class="acc-menu">
            <li><a href="{{ base_url }}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
            <li><a href="{{ base_url }}listpesanan"><i class="fa fa-list"></i>Pesanan</a></li>
            <li><a href="{{ base_url }}meja-pelanggan"><i class="fa fa-table"></i>Meja Pelanggan</a></li>
            <li><a href="{{ base_url }}listpesanan"><i class="fa fa-dollar"></i>Bayar</a></li>
            <li><a href="{{ base_url }}listpesanan"><i class="fa fa-file"></i>Laporan</a></li>
            <li><a href="javascript:void();"><i class="fa fa-database"></i><span>Master Data</span></a>
                <ul class="acc-menu">
                    <li><a href="{{ base_url }}bahan">Bahan</a></li>
                    <li><a href="{{ base_url }}meja">Meja</a></li>
                    <li><a href="{{ base_url }}tipe">Tipe</a></li>
                    <li><a href="{{ base_url }}menu">Menu</a></li>
                </ul>
            </li>
            <li><a href="javascript:void();"><i class="fa fa-lock"></i><span>User Management</span></a>
                <ul class="acc-menu">
                    <li><a href="{{ base_url }}user">User</a></li>
                    <li><a href="{{ base_url }}role">Role</a></li>
                </ul>
            </li>
        </ul>
    @endif

    {{-- Is pelayan --}}
    @if ($get_role['nama'] == 'Pelayan')
        <ul class="acc-menu">
            <li><a href="{{ base_url }}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
            <li><a href="{{ base_url }}meja-pelanggan"><i class="fa fa-table"></i>Meja Pelanggan</a></li>
        </ul>
    @endif

    {{-- Is koki --}}
    @if ($get_role['nama'] == 'Koki')
        <ul class="acc-menu">
            <li><a href="{{ base_url }}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
            <li><a href="{{ base_url }}bahan"><i class="fa fa-list"></i>Bahan</a></li>
            <li><a href="{{ base_url }}menu"><i class="fa fa-list"></i>Menu</a></li>
            <li><a href="{{ base_url }}listpesanan"><i class="fa fa-list"></i>Pesanan</a></li>
        </ul>
    @endif

    {{-- Is kasir --}}
    @if ($get_role['nama'] == 'Kasir')
        <ul class="acc-menu">
            <li><a href="{{ base_url }}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
            <li><a href="{{ base_url }}listpesanan"><i class="fa fa-dollar"></i>Bayar</a></li>
            <li><a href="{{ base_url }}listpesanan"><i class="fa fa-file"></i>Laporan</a></li>
        </ul>
    @endif

</nav>
