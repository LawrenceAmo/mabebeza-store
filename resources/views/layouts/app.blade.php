<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

{{-- <link rel="stylesheet" href="{{ asset('mdb/css/bootstrap.min.css') }}"> --}} 
<link rel="stylesheet" href="{{ asset('mdb/css/mdb.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('mdb/css/mdb.dark.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('mdb/css/admin.layout.css') }}">
<link rel="stylesheet" href="{{ asset('mdb/css/style.css') }}">
         <script src="{{ asset('mdb/js/vue.js') }}"></script>
         <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Libre+Franklin:wght@300&family=Raleway:wght@500;900&display=swap" rel="stylesheet"> 
   
    </head>
    <body class="font-sans antialiased dashboard-container  ">
            <!-- Page Heading -->
           
            <header>
      <!-- Sidebar -->
      <nav
        id="sidebarMenu"
        class="collapse d-lg-block sidebar shadow-2xl  collapse  " style=""
      >
        <div class="position-sticky ">
          <div class="list-group list-group-flush mx-3  ">
            
          <div class="  text-center  d-flex flex-column ">
            <a
              href="{{route('portal')}}"
              class="    " 
              aria-current="true" >
            <img
                src="{{ asset('logo.png') }}"
                height="100"
                alt="mabebeza store logo"
                loading="lazy"
              /> 
          </a>
          <i class="small text-pink"> {{ date('d-M-Y H:i') }} </i>

          </div>
            <a
              href="{{route('portal')}}"
              class="list-group-item list-group-item-action py-2 ripple " 
              aria-current="true"
            >
              <i class="fa fa-tachometer-alt fa-fw h6"></i><span>Dashboard</span>
            </a>
            <a
              href="{{route('profile')}}"
              class="list-group-item list-group-item-action py-2 ripple"
              aria-current="true"
            >
              <i class="fas fa-user-alt fa-fw mr-3"></i><span>My Profile</span>
            </a>
            <a
              href="{{ route("stores")}}"
              class="list-group-item list-group-item-action py-2 ripple"
            >
              <i class="fas fa-building mr-3"></i>
              <span>Stores</span>
            </a>
             <a
              href="{{ route("orders")}}"
              class="list-group-item list-group-item-action py-2 ripple"
              ><i class="fa fa-clipboard-list fa-x2 mr-3"></i> <span> Orders</span></a
            >
            <a
              href="{{ route("my_products")}}"
              class="list-group-item list-group-item-action py-2 ripple"
              ><i class="fa fa-clipboard-list fa-x2 mr-3"></i> <span> Products</span></a
            >
            <a
              href="{{ route("view_customers")}}" 
              class="list-group-item list-group-item-action py-2 ripple"
              ><i class="fa fa-clipboard-list fa-x2 mr-3"></i> <span> Customers</span></a
            >
            <a
              href="{{ route("staff")}}"
              class="list-group-item list-group-item-action py-2 ripple"
              ><i class="fa fa-clipboard-list fa-x2 mr-3"></i> <span> Staff</span></a
            >
            <a
            href="{{ route("categories")}}"
            class="list-group-item list-group-item-action py-2 ripple"
            ><i class="fa fa-clipboard-list fa-x2 mr-3"></i> <span>Categories</span></a
          >
             
              {{-- <a
           href="{{ route('explore')}}"
           class="list-group-item list-group-item-action py-2 ripple"
           ><i class="fas fa-rocket fa-fw mr-3"></i><span>Explore More</span></a
          > --}}
          
          <a
          href="{{ route('suppliers')}}"   
          class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-users fa-fw mr-3"></i 
         ><span>Suppliers</span></a> 
          
            <a
              href="get_help.html"
              class="list-group-item list-group-item-action py-2 ripple"
              ><i class="fas fa-info-circle mr-3"></i><span>Find Help</span></a
            >
            <form action="{{ route('logout') }}" method="POST"
               class="list-group-item  btn-outline-dark text-pink rounded font-weight-bold list-group-item-action py-2 ripple"
              >
              @csrf
              <label for="logout" class="c-pointer text-danger"><i class="fas fa-door-open mr-3"></i><span>Log out</span></label>
              <input type="submit" name="" id="logout" class="d-none" >
              </form
            >
          </div>
        </div>
      </nav>
      <!-- Sidebar -->
      <!-- Navbar -->
      <nav
        id="main-navbar"
        class="navbar navbar-expand-lg navbar-light p-0 bg-white fixed-top"
      >
        <!-- Container wrapper -->
        <div class="container-fluid">
          <!-- Toggle button -->
          <button
            class="navbar-toggler"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#sidebarMenu"
            aria-controls="sidebarMenu"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-bars"></i>
          </button>

          <!-- Brand -->
          <a class="navbar-brand px-3 m-0"  > 
          </a>
          <a class=" text-dark d-flex flex-column justify-content-center px-1 " href="{{route('portal')}}">
            {{-- <img
              src="{{ asset('logo.png') }}"
              height="35"
              alt="mabebeza store logo"
              loading="lazy"
            /> --}}
            <span class=" h5 font-weight-bold">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>
          </a>

          <!-- Right links -->
          <ul class="navbar-nav ms-auto d-flex flex-row">
            <!-- Icon -->
            <li class="nav-item me-3 me-lg-0 d-none">
              <span>Amo</span>
            </li>
            <!-- Icon -->
            <li class="nav-item me-3 me-lg-0">
              <form action="{{ route('logout') }}" method="POST"
               class="nav-link hoverable rounded"
              >
              @csrf
              <label for="logout" class="c-pointer  text-danger"><i class="fas fa-door-open"></i> Log out</label>
              <input type="submit" name="" id="logout" class="d-none" >
              </form
            >
               
            </li>
          </ul>
        </div>
        <!-- Container wrapper -->
      </nav>
      <!-- Navbar -->
    </header>

            <!-- Page Content -->
            
            <main class="mt-5 pt-3 bg-light "  style="">
                <section class="m-0 px-md-3 w-100 bg-light">
                  {{ $slot }}
                </section>
            </main>

            <script src="{{ asset('mdb/js/jquery.min.js') }}"></script>
            <script src="{{ asset('mdb/js/bootstrap.min.js') }}"></script>
      
            <script src="{{ asset('mdb/js/popper.min.js') }}"></script>
            <script src="{{ asset('mdb/js/bootstrap.bundle.min.js') }}"></script>
         <script src="{{ asset('mdb/js/mdb.min.js') }}"></script>
    </body>
</html>

 