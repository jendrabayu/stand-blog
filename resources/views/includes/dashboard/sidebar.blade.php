 <aside id="sidebar-wrapper">
   <div class="sidebar-brand">
     <a href="{{ route('admin.dashboard') }}">Stand Blog</a>
   </div>
   <div class="sidebar-brand sidebar-brand-sm">
     <a href="{{ route('admin.dashboard') }}">SB</a>
   </div>
   <ul class="sidebar-menu">
     <li class="menu-header">Dashboard</li>
     <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
       <a class="nav-link" href="{{ route('admin.dashboard') }}"><i
           class="fas fas fa-fire"></i><span>Dashboard</span></a>
     </li>
     <li class="{{ request()->routeIs('admin.category') ? 'active' : '' }}">
       <a class="nav-link" href="{{ route('admin.category') }}"><i
           class="fas fas fa-fire"></i><span>Category</span></a>
     </li>
     <li class="{{ request()->routeIs('admin.tag') ? 'active' : '' }}">
       <a class="nav-link" href="{{ route('admin.tag') }}"><i class="fas fas fa-fire"></i><span>Tag</span></a>
     </li>
     <li class="nav-item dropdown">
       <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Post</span></a>
       <ul class="dropdown-menu">
         <li><a class="nav-link" href="{{ route('admin.post.create') }}">Create</a></li>
         <li><a class="nav-link" href="{{ route('admin.post.index') }}">List</a></li>
       </ul>
     </li>
   </ul>

   <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
     <a href="/" class="btn btn-primary btn-lg btn-block btn-icon-split">
       <i class="fas fa-rocket"></i> Home Page
     </a>
   </div>
 </aside>
