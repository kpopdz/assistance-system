<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
  <link href="{{ asset('css/quiz.css') }}" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>

  <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>


  <!-- Template Main CSS File -->
  <link href="/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        rel="stylesheet" />
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center justify-content-between">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <span class="d-none d-lg-block me-1" style="padding-bottom: 21px;"> school </span>

        <img src="{{asset('assets/img/logoAss.png')}}" alt="">
        <span class="d-none d-lg-block" style="padding-top: 21px;">sistance </span>
      </a>
      @if (Auth::user())
      <i class="bi bi-list toggle-sidebar-btn"></i>

      @endif
    </div><!-- End Logo -->
@if (Auth::user())


  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->

      <li class="nav-item dropdown dropdown-notifications">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <span class="badge bg-primary badge-number" data-count="{{Auth::user()->unreadnotifications->count()}}">{{Auth::user()->unreadnotifications->count()}}</span>
        </a><!-- End Notification Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications notif-real">
          <li class="dropdown-header">
            You have 4 new notifications
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
@forelse (Auth::user()->unreadnotifications as $notification)
<li class="notification-item">
    <i class="bi bi-exclamation-circle text-warning"></i>
    <div>
      <h4>assigned quiz to you</h4>
      <p>the teacher {{$notification->data['name']}} assigned quiz {{$notification->data['title']}} to you click
    here to redirect to the <a href="{{route('markasread',$notification->id)}}">quiz</a>  </p>
      <p>{{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</p>
    </div>
  </li>

  <li>
    <hr class="dropdown-divider">
  </li>
@empty
<li class="notification-item">
    <i class="bi bi-exclamation-circle text-warning"></i>
    <div>
      <h4>nothening</h4>

    </div>
  </li>

  <li>
    <hr class="dropdown-divider">
  </li>
@endforelse
{{-- <li class="notification-item">
    <i class="bi bi-exclamation-circle text-warning"></i>
    <div>
      <h4>Lorem Ipsum</h4>
      <p>Quae dolorem earum veritatis oditseno</p>
      <p>30 min. ago</p>
    </div>
  </li>

  <li>
    <hr class="dropdown-divider">
  </li>

  <li class="notification-item">
    <i class="bi bi-x-circle text-danger"></i>
    <div>
      <h4>Atque rerum nesciunt</h4>
      <p>Quae dolorem earum veritatis oditseno</p>
      <p>1 hr. ago</p>
    </div>
  </li>

  <li>
    <hr class="dropdown-divider">
  </li>

  <li class="notification-item">
    <i class="bi bi-check-circle text-success"></i>
    <div>
      <h4>Sit rerum fuga</h4>
      <p>Quae dolorem earum veritatis oditseno</p>
      <p>2 hrs. ago</p>
    </div>
  </li>

  <li>
    <hr class="dropdown-divider">
  </li>

  <li class="notification-item">
    <i class="bi bi-info-circle text-primary"></i>
    <div>
      <h4>Dicta reprehenderit</h4>
      <p>Quae dolorem earum veritatis oditseno</p>
      <p>4 hrs. ago</p>
    </div>
  </li> --}}







          <li>
            <hr class="dropdown-divider">
          </li>
          <li class="dropdown-footer">
            <a href="#">Show all notifications</a>
          </li>

        </ul><!-- End Notification Dropdown Items -->

      </li><!-- End Notification Nav -->

      <li class="nav-item dropdown">

        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-chat-left-text"></i>
          <span class="badge bg-success badge-number">3</span>
        </a><!-- End Messages Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
          <li class="dropdown-header">
            You have 3 new messages
            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Maria Hudson</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>4 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
              <div>
                <h4>Anna Nelson</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>6 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="message-item">
            <a href="#">
              <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
              <div>
                <h4>David Muldon</h4>
                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                <p>8 hrs. ago</p>
              </div>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li class="dropdown-footer">
            <a href="#">Show all messages</a>
          </li>

        </ul><!-- End Messages Dropdown Items -->

      </li><!-- End Messages Nav -->

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @if (Auth::user()->avatar)
            <img src="{{url(Auth::user()->avatar)}}" alt="Profile" class="rounded-circle">


            @else
            <img src="{{url('icons/Account-Avatar.png')}}" alt="Profile" class="rounded-circle">

            @endif
          <span class="d-none d-md-block dropdown-toggle ps-2"> {{ Auth::user()->name }}
          </span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>Kevin Anderson</h6>
            <span>Web Designer</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>

@if (Auth::user()->role=='student')
<a class="dropdown-item d-flex align-items-center" href="
{{ route('student.profile') }}
">
  <i class="bi bi-person"></i>
  <span>My Profile</span>
</a>
@endif
@if (Auth::user()->role=='admin')
<a class="dropdown-item d-flex align-items-center" href="
{{ route('profile.admin') }}
">
  <i class="bi bi-person"></i>
  <span>My Profile</span>
</a>
@endif

          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
              <i class="bi bi-gear"></i>
              <span>Account Settings</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
              <i class="bi bi-question-circle"></i>
              <span>Need Help?</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">

              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->
@else

     <div class="me-5">                        <a href="{{ route('login') }}" class="
        btn btn-outline-dark me-3">Log in</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-outline-dark">Register</a>
        @endif
        @endif
@if (Auth::user())
<aside id="sidebar" class="sidebar">

@if (Auth::user()->role=="teacher")
<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a @if (Request::url()===url('/lay'))
        class="nav-link"
        @else
        class="nav-link  collapsed"
        @endif  href="{{ url('/lay')}}">
          <i class="bi bi-plus-circle"></i>
          <span>create quiz</span>
        </a>
      </li>

  <li class="nav-item">
    <a class="nav-link {{Route::is('home') ? '' : 'collapsed' }}  " href="{{ url('home')}}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{Route::is('quizs.index') ? '' : 'collapsed' }}" href="{{ route('quizs.index')}}">
      <i class="bi bi-grid"></i>
      <span>My Quizs</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{Route::is('quizzes.shared.teachers') ? '' : 'collapsed' }}" href="{{ route('quizzes.shared.teachers')}}">
        <i class="ri-share-fill"></i>      <span>shared from teachers</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{Route::is('teacher.myquizs') ? '' : 'collapsed' }}  " href="{{ route('teacher.myquizs')}}">
        <i class="ri-send-plane-2-line"></i>
      <span>assigned quizs</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{Route::is('stat.list') ? '' : 'collapsed' }}  " href="{{ route('stat.list')}}">
        <i class="bi bi-clipboard-data"></i>      <span>View analysis reports & Statistics</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{Route::is('courses.view') ? '' : 'collapsed' }}  " href="{{ route('courses.view')}}">
      <i class="bi bi-grid"></i>
      <span>view my courses</span>
    </a>
  </li>


</ul>

@endif

@if (Auth::user()->role=="student")
<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
        <a @if (Request::url()===url('/lay'))
        class="nav-link"
        @else
        class="nav-link  collapsed"
        @endif  href="{{ route('public.quizs')}}">
          <i class="bi bi-plus-circle"></i>
          <span>Quizs assign to me</span>
        </a>
      </li>

  <li class="nav-item">
    <a class="nav-link {{Route::is('public.quizs.index') ? '' : 'collapsed' }}  " href="{{ route('public.quizs.index')}}">
        <i class="bi bi-card-list"></i>
      <span>public quizs</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{Route::is('public.courses') ? '' : 'collapsed' }}" href="{{ route('public.courses')}}">
        <i class="bi bi-collection-fill"></i>      <span>view courses</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link {{Route::is('quizs.index') ? '' : 'collapsed' }}" href="{{ route('quizs.index')}}">
      <i class="bi bi-grid"></i>
      <span>my students</span>
    </a>
  </li>
</ul>
@endif
@if (Auth::user()->role=="parent")
<ul class="sidebar-nav" id="sidebar-nav">



  <li class="nav-item">
    <a class="nav-link {{Route::is('home') ? '' : 'collapsed' }}  " href="{{ route('parent.child')}}">
      <i class="bi bi-grid"></i>
      <span>my shild</span>
    </a>
  </li>

</ul>


@endif
@if (Auth::user()->role=="admin")
<ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
        <a class="nav-link collapsed" href="">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{Route::is('students.list') ? '' : 'collapsed' }}" href="{{ route('students.list')}}">
          <i class="bi bi-grid"></i>
          <span>Students</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{Route::is('teachers.list') ? '' : 'collapsed' }}" href="{{ route('teachers.list')}}">
          <i class="bi bi-grid"></i>
          <span>teachers</span>
        </a>
      </li>
  <li class="nav-item">
    <a class="nav-link {{Route::is('parents.list') ? '' : 'collapsed' }}  " href="{{ route('parents.list')}}">
      <i class="bi bi-grid"></i>
      <span>Parents</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link {{Route::is('view.classroom.list') ? '' : 'collapsed' }}" href="{{ route('view.classroom.list')}}">
      <i class="bi bi-grid"></i>
      <span>classes</span>
    </a>
  </li>
</ul>



@endif

{{--

        <ul class="sidebar-nav" id="sidebar-nav">

      <!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link  collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{Route('teacher.myquizs')}}">
              <i class="bi bi-circle"></i><span>results</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>Accordion</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Badges</span>
            </a>
          </li>
          <li>
            <a href="components-breadcrumbs.html">
              <i class="bi bi-circle"></i><span>Breadcrumbs</span>
            </a>
          </li>
          <li>
            <a href="components-buttons.html">
              <i class="bi bi-circle"></i><span>Buttons</span>
            </a>
          </li>
          <li>
            <a href="components-cards.html">
              <i class="bi bi-circle"></i><span>Cards</span>
            </a>
          </li>
          <li>
            <a href="components-carousel.html">
              <i class="bi bi-circle"></i><span>Carousel</span>
            </a>
          </li>
          <li>
            <a href="components-list-group.html">
              <i class="bi bi-circle"></i><span>List group</span>
            </a>
          </li>
          <li>
            <a href="components-modal.html">
              <i class="bi bi-circle"></i><span>Modal</span>
            </a>
          </li>
          <li>
            <a href="components-tabs.html">
              <i class="bi bi-circle"></i><span>Tabs</span>
            </a>
          </li>
          <li>
            <a href="components-pagination.html">
              <i class="bi bi-circle"></i><span>Pagination</span>
            </a>
          </li>
          <li>
            <a href="components-progress.html">
              <i class="bi bi-circle"></i><span>Progress</span>
            </a>
          </li>
          <li>
            <a href="components-spinners.html">
              <i class="bi bi-circle"></i><span>Spinners</span>
            </a>
          </li>
          <li>
            <a href="components-tooltips.html">
              <i class="bi bi-circle"></i><span>Tooltips</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><span>Form Elements</span>
            </a>
          </li>
          <li>
            <a href="forms-layouts.html">
              <i class="bi bi-circle"></i><span>Form Layouts</span>
            </a>
          </li>
          <li>
            <a href="forms-editors.html">
              <i class="bi bi-circle"></i><span>Form Editors</span>
            </a>
          </li>
          <li>
            <a href="forms-validation.html">
              <i class="bi bi-circle"></i><span>Form Validation</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>General Tables</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Data Tables</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="charts-chartjs.html">
              <i class="bi bi-circle"></i><span>Chart.js</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>ApexCharts</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>ECharts</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Remix Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-boxicons.html">
              <i class="bi bi-circle"></i><span>Boxicons</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li><!-- End Blank Page Nav -->

    </ul>
--}}


  </aside><!-- End Sidebar-->
@endif

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->


  <main id="main" class="main">
    @auth
    @if (Auth::user()->role=="student" )
    <div class="row d-flex mb-3 " style="background-image: linear-gradient( 135deg, #FDEB71 10%, #F8D800 100%);
    padding-top: 10px; position:fixed;width:50%;z-index:1000;top:60px;right:25%;
    border:1px solid #9d8802;
    border-radius:3px">
        <div class="col-4"><div class="progress">
            <div class="progress-bar progress-bar-striped bg-info progress-bar-animated" id="scoresize" role="progressbar" style="width: {{((Auth::user()->student->points->points)/200)*100}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
              </div><div class="col-2"><h5 id="pointcount">{{Auth::user()->student->points->points}} points</h5></div></div>

    @endif
    @endauth

<div class="mb-5"></div>
    @yield('content')

  </main>


  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
  <script>
Pusher.logToConsole = true;

var pusher = new Pusher('f7375d4f2203ec0c9b5b', {
  cluster: 'eu'
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
  alert(JSON.stringify(data));
});
  </script>
  <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  <script src="{{asset('/js/pusherNotifications.js')}}"></script>

</body>

</html>
