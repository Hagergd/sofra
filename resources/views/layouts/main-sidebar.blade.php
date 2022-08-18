<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Sofra</span>
    </a>
@inject('client','App\Models\Client')
@inject('resturant','App\Models\Resturant')
@inject('order','App\Models\Order')
@inject('comment','App\Models\Comment')
@inject('offer','App\Models\Offer')
@inject('meal','App\Models\Meal')
@inject('city','App\Models\City')
@inject('region','App\Models\Region')
@inject('contact','App\Models\Contact')
@inject('category','App\Models\Category')
@inject('setting','App\Models\Setting')
@inject('user','App\Models\User')



    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/img/user1-128x128.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
          
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
         <li class="nav-item">
            <a href="{{ url('/' . $page='home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashbord
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          

          <li class="nav-item">
            <a href="{{ url('/' . $page='regions') }}" class="nav-link">
              <i class="nav-icon fa fa-globe"></i>
              <p>
                Regions
                <span class="badge badge-info right">{{$region->count()}}</span>
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{ url('/' . $page='cities') }}" class="nav-link">
              <i class="nav-icon fa fa-location-arrow"></i>
              <p>
                Cities
                <span class="badge badge-info right">{{$city->count()}}</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/' . $page='categories') }}" class="nav-link">
              <i class="nav-icon fa fa-tags"></i>
              <p>
                Categories
                <span class="badge badge-info right">{{$category->count()}}</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/' . $page='resturants') }}" class="nav-link">
              <i class="nav-icon fa fa-window-restore"></i>
              <p>
                Resturants
                <span class="badge badge-info right">{{$resturant->count()}}</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/' . $page='meals') }}" class="nav-link">
              <i class="nav-icon fa fa-window-restore"></i>
              <p>
                Meals
                <span class="badge badge-info right">{{$meal->count()}}</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/' . $page='offers') }}" class="nav-link">
              <i class="nav-icon fa fa-window-restore"></i>
              <p>
                Offers
                <span class="badge badge-info right">{{$offer->count()}}</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/' . $page='clients') }}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Clients
                <span class="badge badge-info right">{{$client->count()}}</span>
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ url('/' . $page='contacts') }}" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Contacts
                <span class="badge badge-info right">{{$contact->count()}}</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/' . $page='orders') }}" class="nav-link">
              <i class="nav-icon fa fa-calendar-alt"></i>
              <p>
                Orders
                <span class="badge badge-info right">{{$order->count()}}</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/' . $page='comments') }}" class="nav-link">
              <i class="nav-icon fa fa-comments"  ></i>
              <p>
                Comments
                <span class="badge badge-info right">{{$comment->count()}}</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/' . $page='settings') }}" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Settings
                <span class="badge badge-info right">{{$setting->count()}}</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/' . $page='roles') }}" class="nav-link">
              <i class="nav-icon fa fa-bars"></i>
              <p>
                Roles
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/' . $page='permissions') }}" class="nav-link">
              <i class="nav-icon fa fa-bars"></i>
              <p>
                Permissions
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/' . $page='users') }}" class="nav-link">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>
                Users
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/' . $page='admins') }}" class="nav-link">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Change admin password
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('/logout' ) }}" class="nav-link">
              <i class="nav-icon fa fa-sign-out"></i>
              <p>
                Logout
                <span class="badge badge-info right"></span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>