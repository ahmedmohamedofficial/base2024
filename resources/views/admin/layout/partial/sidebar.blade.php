<div class="app-brand demo">
    <a href="{{ url('admin/dashboard')}}" class="app-brand-link">
              <span class="app-brand-logo demo">
               <img class="brand-logo img-logo w-auto h-auto" style="width: 55px !important;" src="{{ settings('logo')  }}" alt="">
              </span>
        <span class="app-brand-text demo menu-text fw-bold">{{ settings('name', true) }}</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
</div>

<div class="menu-inner-shadow"></div>
<ul class="menu-inner py-1">

{!! \App\Traits\SideBarTrait::sidebar() !!}
</ul>
