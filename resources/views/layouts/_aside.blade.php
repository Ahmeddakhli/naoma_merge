<aside class="main-sidebar" style="position: fixed !important;">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://lwlies.com/wp-content/uploads/2017/04/avatar-2009.jpg" alt="" class="img-circle">
            </div>
            <div class="pull-left info">
                <p>اسم الادمن</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
               <li class=" treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>الغرف</span> <i class="fa fa-angle-left pull-left"></i>
                   <small class="label pull-left bg-red">3</small>

              </a>
              <ul class="treeview-menu">

                <li><a href="{{ route('rooms.index') }} "><i class="fa fa-table"></i>عرض كل الغرف</a></li>
                <li><a href="{{ route('rooms.create') }}"><i class="fa fa-plus"></i> اضافه غرفه</a></li>
]
              </ul>
            </li>
            <li class=" treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>الميكروفونات</span> <i class="fa fa-angle-left pull-left"></i>
                                

              </a>
              <ul class="treeview-menu">

                <li><a href="{{ route('room_mics.index') }} "><i class="fa fa-table"></i>عرض كل الميكروفونات</a></li>
                

              </ul>
            </li>

            <li><a href="#"><i class="fa fa-th"></i><span>الاقسام</span></a></li>
            <li><a href="#"><i class="fa fa-th"></i><span>المنتجات</span></a></li>
            <li><a href="#"><i class="fa fa-th"></i><span>المستخدمين</span></a></li>

        </ul>

    </section>

</aside>

