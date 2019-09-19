
<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1 fa fa-coffee" href="/">Coffee</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="البحث عن" aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

<?php
if(($_SESSION['lvl'] < 2) || !isset($_SESSION['lvl']))
{
	echo "<!--";
}
?>
<ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Users</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>
  <?php
if(($_SESSION['lvl'] < 2) || !isset($this->session->userdata['lvl']))
{
	echo  "!-->   ";
}
?>
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"
        href="#" id="pagesDropdown"
        role="button"
         data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>المخزن</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">السلع و المخزن</h6>
          <a class="dropdown-item" href="<?php echo site_link_to('Admin/wh'); ?>">السلع الاساسية</a>
          <a class="dropdown-item" href="<?php echo site_link_to('Admin/wh/listing'); ?>">معرض السلع</a>
          <a class="dropdown-item" href="<?php echo site_link_to('Admin/wh_cat/'); ?>">تصنيفات السلع</a>
          <a class="dropdown-item" href="<?php echo site_link_to('Admin/store/'); ?>">المخزن</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">الحسابات</h6>
          <a class="dropdown-item" href="/admin/expt/all">اصناف المصروفات</a>
          <a class="dropdown-item" href="/admin/expenses/all">المصروفات</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"
        href="#" id="mealsDropDown"
        role="button"
         data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-sandwich"></i>
          <span>الوجبات </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="mealsDropDown">
          <h6 class="dropdown-header">الوجبات و الاطعمة</h6>
          <a class="dropdown-item" href="<?php echo site_link_to('Admin/meals'); ?>">

          </a>
          <a class="dropdown-item" href="<?php echo site_link_to('Admin/meals/'); ?>">الماكولات</a>
          <a class="dropdown-item" href="<?php echo site_link_to('Admin/orders/'); ?>">الطلبات</a>
          <a class="dropdown-item" href="<?php echo site_link_to('Admin/useditems/'); ?>">المواد المستخدمة</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">الحسابات</h6>
          <a class="dropdown-item" href="/admin/expt/all">اصناف المصروفات</a>
          <a class="dropdown-item" href="/admin/expenses/all">المصروفات</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.html   ">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>
    </ul>

    <div id="content-wrapper">
	<div class="container-fluid">
