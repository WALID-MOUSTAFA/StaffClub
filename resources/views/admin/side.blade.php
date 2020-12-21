<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-navy elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">

	<img src="{{asset('css/adminlte3/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
	<br/>
	<span class="brand-text font-weight-light">نادي أعضاء هيئة التدريس</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
              <img src="/uploads/{{ session()->get("user")->pic }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{ session()->get("user")->fullname }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
		   with font-awesome or any other icon font library -->

	      <li class="nav-item has-treeview ">
		  <a href="/admin/mods" class="nav-link ">
		      <i class="nav-icon fas fa-tachometer-alt"></i>
		      <p>
			  المشرفين
			  <!-- <i class="right fas fa-angle-left"></i> -->
		      </p>
		  </a>
	      </li>

	      
	    
	    <li class="nav-item has-treeview ">
		<a href="/admin/members" class="nav-link ">
		    <i class="nav-icon fas fa-tachometer-alt"></i>
		    <p>
			الأعضاء
			<!-- <i class="right fas fa-angle-left"></i> -->
		    </p>
		</a>
	    </li>


	    <li class="nav-item has-treeview ">
		<a href="/admin/polls" class="nav-link ">
		    <i class="nav-icon fas fa-tachometer-alt"></i>
		    <p>
			الاستبيانات
			<!-- <i class="right fas fa-angle-left"></i> -->
		    </p>
		</a>
		<!-- <ul class="nav nav-treeview">
		     <li class="nav-item">
		     <a href="./index.html" class="nav-link active">
		     <i class="far fa-circle nav-icon"></i>
		     عرض الكل
		     </a>
		     </li>
		     <li class="nav-item">
		     <a href="./index2.html" class="nav-link">
		     <i class="far fa-circle nav-icon"></i>
		     <p>Dashboard v2</p>
		     </a>
		     </li>
		     <li class="nav-item">
		     <a href="./index3.html" class="nav-link">
		     <i class="far fa-circle nav-icon"></i>
		     <p>Dashboard v3</p>
		     </a>
		     </li>
		     </ul> -->
	    </li>

	    

	    
	</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
