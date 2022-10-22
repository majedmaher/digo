<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="ar">

<head>
  <style>
    a,
    a:visited,
    a:focus {
      text-decoration: none !important;
      color: #0d6efd;
    }
  </style>

  <meta charset="UTF-8">
  <title> Dashboard </title>
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Boxiocns CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
  <link rel="stylesheet" href="{{asset('https://pro.fontawesome.com/releases/v5.10.0/css/all.css')}}" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  @yield('styles')
</head>

<body>
  <div class="sidebar close">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">DIGO</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="{{route('dashboard')}}">
          <i class='bx bx-home-alt'></i>
          <span class="link_name">الرئيسية</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{route('dashboard')}}">الرئيسية</a></li>
        </ul>
      </li>
      <li>
      <li>
        <a href="{{route('notification')}}">
          <i class='bx bx-notification'></i>
          <span class="link_name">ارسال إشعار</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{route('notification')}}">أرسل إشعار</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="{{route('slider.show')}}">
            <i class='bx bx-slider'></i>
            <span class="link_name">السلايدر</span>
          </a>
          <i class="bx bxs-chevron-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('slider.show')}}">السلايدر</a></li>
          <li><a href="{{route('slider.create')}}">اضف السلايدر</a></li>
          <li><a href="{{route('slider.show')}}">عرض السلايدر</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="{{route('mails')}}">
            <i class='bx bx-mail-send'></i>
            <span class="link_name">الايميلات</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('mails')}}">الايميلات</a></li>
          <li><a href="{{route('mail.create')}}">اضف ايميل</a></li>
          <li><a href="{{route('mails')}}">الايميلات الموجودة مسبقًا</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="{{route('packages.index')}}">
            <i class='bx bx-package'></i>
            <span class="link_name">الباقات</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('packages.index')}}">الباقات</a></li>
          <li><a href="{{route('packages.create')}}">اضف باقة</a></li>
          <li><a href="{{route('packages.index')}}">الباقات الموجودة مسبقًا</a></li>
        </ul>
      </li>
      <li>
        <a href="{{route('payments')}}">
          <i class='bx bx-credit-card'></i>
          <span class="link_name">عمليات الدفع</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{route('payments')}}">عمليات الدفع</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="{{route('companys.show')}}">
            <i class='bx bxs-factory'></i>
            <span class="link_name">الشركات</span>
          </a>
          <i class="bx bxs-chevron-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('companys.show')}}">الشركات</a></li>
          <li><a href="{{route('company.create')}}">اضف شركة</a></li>
          <li><a href="{{route('companys.show')}}">عرض الشركات</a></li>
        </ul>
      </li>
      <li>
        <a href="{{route('transfers.financial.claim')}}">
          <i class='fa fa-file-invoice-dollar'></i>
          <span class="link_name">الحوالات المالية</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{route('transfers.financial.claim')}}">الحوالات المالية</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="{{route('officers.show')}}">
            <i class='bx bx-user-circle'></i>
            <span class="link_name">الموظفين</span>
          </a>
          <i class="bx bxs-chevron-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('officers.show')}}">الموظفين</a></li>
          <li><a href="{{route('officer.create')}}">اضف موظف</a></li>
          <li><a href="{{route('officers.show')}}">عرض الموظفين</a></li>
        </ul>
      </li>
      <li>
        <a href="{{route('presence.absence.index')}}">
          <i class='fa fa-business-time'></i>
          <span class="link_name">الحضور والغياب</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{route('presence.absence.index')}}">الحضور والغياب</a></li>
        </ul>
      </li>
      <li>
        <a href="{{route('sections.show')}}">
          <i class='bxs bx-home-alt'></i>
          <span class="link_name">الأقسام</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{route('sections.show')}}">الأقسام</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="{{route('services.show')}}">
            <i class='bx bx-copy'></i>
            <span class="link_name">الخدمات</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('services.show')}}">الخدمات</a></li>
          <li><a href="{{route('service.create')}}">اضف خدمة</a></li>
          <li><a href="{{route('services.show')}}">الخدمات الموجودة مسبقًا</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="{{route('works.show')}}">
            <i class='bx bx-mail-send'></i>
            <span class="link_name">أعمالنا</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('works.show')}}">أعمالنا</a></li>
          <li><a href="{{route('work.create')}}">اضف عمل</a></li>
          <li><a href="{{route('works.show')}}">الأعمال الموجودة مسبقًا</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="{{route('clients.show')}}">
            <i class='bx bx-user'></i>
            <span class="link_name">العملاء</span>
          </a>
          <i class="bx bxs-chevron-down arrow"></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="{{route('clients.show')}}">العملاء</a></li>
          <li><a href="{{route('client.create')}}">اضف عميل</a></li>
          <li><a href="{{route('clients.show')}}">عرض العملاء</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="{{route('blogs.show')}}">
            <i class='bx bxl-blogger'></i>
            <span class="link_name">المدونة</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">المدونة</a></li>
          <li><a href="{{route('blog.create')}}">اضف مقالة</a></li>
          <li><a href="{{route('blogs.show')}}">المقالات الموجودة مسبقًا</a></li>
        </ul>
      </li>
      <li>
        <a href="{{route('subscribes.show')}}">
          <i class='bx bx-user-check'></i>
          <span class="link_name">المشتركين</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{route('subscribes.show')}}">المشتركين</a></li>
        </ul>
      </li>
      <li>
        <a href="{{route('job.requests.show')}}">
          <i class='bx bxs-file-pdf'></i>
          <span class="link_name">طلبات العمل</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{route('job.requests.show')}}">طلبات العمل</a></li>
        </ul>
      </li>
      <li>
        <a href="{{route('orders.show')}}">
          <i class='bx bx-git-pull-request'></i>
          <span class="link_name">الطلبات</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{route('orders.show')}}">الطلبات</a></li>
        </ul>
      </li>
      <li>
        <a href="{{route('contacts.show')}}">
          <i class='bx bxs-contact'></i>
          <span class="link_name">اتصل بنا</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="{{route('contacts.show')}}">اتصل بنا</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fas fa-user-cog"></i>
            {{-- <i class='bx bxs-user-circle'></i> --}}
            <span class="link_name">الاعدادت</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>

        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">الاعدادت</a></li>
          <li><a href="#">اضافة مستخدم</a></li>
          <li><a href="{{route('users')}}">عرض المستخدمين</a></li>
        </ul>
      </li>

    </ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
      <span class="text">DIGO</span>
    </div>

    @yield('content')
  </section>

  @yield('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('js/dashboard.js')}}"></script>

</body>

</html>