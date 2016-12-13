
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">

        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active">
                    <a href="{{url('admin/home')}}">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>


                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">assignment</i>
                        <span>News</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('admin/news/get-all-news')}}">See News</a>
                        </li>



                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">book</i>
                        <span>Category</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('admin/category/all')}}">See All Category</a>
                        </li>

                        <li>
                            <a href="{{url('admin/category/add-new')}}">Add a new category</a>
                        </li>

                    </ul>
                </li>





                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">account_circle</i>
                        <span>Users</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="{{url('admin/app-user/all')}}">See All User</a>
                        </li>

                        <li>
                            <a href="{{url('admin/admin-user/add-new')}}">Add New Admin</a>
                        </li>

                    </ul>
                </li>




            </ul>
        </div>
        <!-- #Menu -->

    </aside>
    <!-- #END# Left Sidebar -->