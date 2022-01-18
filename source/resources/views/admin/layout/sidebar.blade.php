<style>
    .activate{
            background-color: #b5b5c0 !important;
    color: white !important;
    }
</style>
<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo"><a href="{{route('adminHome')}}" class="simple-text logo-normal">
          {{$logo->name}}
        </a></div>
      <div class="sidebar-wrapper" id="menu">
        <ul class="nav">
     
          <li class="{{ (request()->is('home')) ? 'active' : '' }} nav-item">
            <a class="nav-link" href="{{route('adminHome')}}" active>
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          
           <li class="{{ (request()->is('Notification')) ? 'active' : '' }} nav-item">
             <a class="nav-link" href="{{route('adminNotification')}}">
             <i class="material-icons">notifications</i>
              <span class="menu-title">Send Notification</span>
            </a>
           
          </li>
      
          <li class="nav-item {{ (request()->is('global_settings')) ? 'active' : '' }} {{ (request()->is('app_settings')) ? 'active' : '' }} {{ (request()->is('msgby')) ? 'active' : '' }} {{ (request()->is('map_api')) ? 'active' : '' }} {{ (request()->is('app_notice')) ? 'active' : '' }}{{ (request()->is('cancelling_reasons/list')) ? 'active' : '' }} ">
            <a class="nav-link" data-toggle="collapse" href="#setting-dropdown2" aria-expanded="false" aria-controls="setting-dropdown">
              <i class="material-icons">settings</i>
              <span class="menu-title">Settings<b class="caret"></b></span>
            </a>
            <div class="collapse  {{ (request()->is('global_settings')) ? 'show' : '' }} {{ (request()->is('app_settings')) ? 'show' : '' }} {{ (request()->is('msgby')) ? 'show' : '' }} {{ (request()->is('map_api')) ? 'show' : '' }}{{ (request()->is('app_notice')) ? 'show' : '' }}{{ (request()->is('cancelling_reasons/list')) ? 'show' : '' }} " id="setting-dropdown2">
              <ul class="nav flex-column sub-menu">
                   <li class="nav-item">
                        <a class="{{ (request()->is('global_settings')) ? 'activate' : '' }} nav-link" href="{{route('app_details')}}">Global Settings</a>
                    </li>
                     <li class="nav-item">
                        <a class="{{ (request()->is('app_settings')) ? 'activate' : '' }} nav-link" href="{{route('app_settings')}}"> App Settings</a>
                    </li>
                   <li class="nav-item">
                        <a class="{{ (request()->is('msgby')) ? 'activate' : '' }} nav-link" href="{{route('msg91')}}">SMS/OTP API</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ (request()->is('map_api')) ? 'activate' : '' }} nav-link" href="{{route('mapapi')}}">Map API</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ (request()->is('app_notice')) ? 'activate' : '' }} nav-link" href="{{route('app_notice')}}">App Notice</a>
                    </li>
                     <li class="nav-item">
                        <a class="{{ (request()->is('cancelling_reasons/list')) ? 'activate' : '' }} nav-link" href="{{route('can_res_list')}}">Cancelling Reason</a>
                    </li>
                </ul>
                </div>
          </li>
            <li class="nav-item {{ (request()->is('category/list')) ? 'active' : '' }} {{ (request()->is('product/list')) ? 'active' : '' }} {{ (request()->is('deal/list')) ? 'active' : '' }} {{ (request()->is('top-cat')) ? 'active' : '' }}{{ (request()->is('bulk/upload')) ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#cat-dropdown" aria-expanded="false" aria-controls="setting-dropdown">
             <i class="material-icons">content_paste</i>
              <span class="menu-title">Category/products<b class="caret"></b></span>
            </a>
            <div class="collapse {{ (request()->is('category/list')) ? 'show' : '' }} {{ (request()->is('product/list')) ? 'show' : '' }} {{ (request()->is('deal/list')) ? 'show' : '' }} {{ (request()->is('top-cat')) ? 'show' : '' }}{{ (request()->is('bulk/upload')) ? 'show' : '' }}" id="cat-dropdown">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="{{ (request()->is('category/list')) ? 'activate' : '' }} nav-link" href="{{route('catlist')}}">Categories</a>
                </li>
                <li class="nav-item">
                  <a class="{{ (request()->is('product/list')) ? 'activate' : '' }} nav-link" href="{{route('productlist')}}">Product</a>
                </li>
                 <li class="nav-item">
                  <a class="{{ (request()->is('bulk/upload')) ? 'activate' : '' }} nav-link" href="{{route('bulkup')}}">Bulk Upload</a>
                </li>
                
                <li class="nav-item">
                  <a class="{{ (request()->is('deal/list')) ? 'activate' : '' }} nav-link" href="{{route('deallist')}}">Deal Products</a>
                </li>
                 <li class="nav-item">
                  <a class="{{ (request()->is('top-cat')) ? 'activate' : '' }} nav-link" href="{{route('adminTopCat')}}">Home Category</a>
                </li>
                </ul>
                </div>
          </li>
         
          <li class="nav-item {{ (request()->is('user/list')) ? 'active' : '' }}">
            <a class="nav-link" href="{{route('userlist')}}">
              <i class="material-icons">android</i>
              <p>App Users</p>
            </a>
          </li>
          <li class="nav-item {{ (request()->is('citylist')) ? 'active' : '' }}">
            <a class="nav-link" href="{{route('citylist')}}">
              <i class="material-icons">location_city</i>
              <p>Cities</p>
            </a>
          </li>
        
            <li class="nav-item {{ (request()->is('admin/store/list')) ? 'active' : '' }} {{ (request()->is('finance')) ? 'active' : '' }} {{ (request()->is('waiting_for_approval/stores/list')) ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#store-dropdown" aria-expanded="false" aria-controls="setting-dropdown">
             <i class="material-icons">house</i>
              <span class="menu-title">Store Management<b class="caret"></b></span>
            </a>
            <div class="collapse {{ (request()->is('admin/store/list')) ? 'show' : '' }} {{ (request()->is('finance')) ? 'show' : '' }} {{ (request()->is('waiting_for_approval/stores/list')) ? 'show' : '' }}" id="store-dropdown">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link {{ (request()->is('admin/store/list')) ? 'activate' : '' }}" href="{{route('storeclist')}}">Store</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ (request()->is('finance')) ? 'activate' : '' }}" href="{{route('finance')}}">Store Earnings/Payments</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ (request()->is('waiting_for_approval/stores/list')) ? 'activate' : '' }}" href="{{route('storeapprove')}}">Waiting For Approval</a>
                </li>
                </ul>
                </div>

          </li>
         <li class="nav-item {{ (request()->is('admin/store/cancelledorders')) ? 'active' : '' }} {{ (request()->is('admin/completed_orders')) ? 'active' : '' }} {{ (request()->is('admin/pending_orders')) ? 'active' : '' }} {{ (request()->is('admin/cancelled_orders')) ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#ord-dropdown" aria-expanded="false" aria-controls="setting-dropdown">
             <i class="material-icons">layers</i>
              <span class="menu-title">Orders<b class="caret"></b></span>
            </a>
            <div class="collapse {{ (request()->is('admin/store/cancelledorders')) ? 'show' : '' }} {{ (request()->is('admin/completed_orders')) ? 'show' : '' }} {{ (request()->is('admin/pending_orders')) ? 'show' : '' }} {{ (request()->is('admin/cancelled_orders')) ? 'show' : '' }}" id="ord-dropdown">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link {{ (request()->is('admin/store/cancelledorders')) ? 'activate' : '' }}" href="{{route('store_cancelled')}}">Rejected By Store</a>
                </li>
                <li class="nav-item">
                  <a class="{{ (request()->is('admin/completed_orders')) ? 'activate' : '' }} nav-link" href="{{route('admin_com_orders')}}">Completed Orders</a>
                </li>
                  <li class="nav-item">
                  <a class="nav-link {{ (request()->is('admin/pending_orders')) ? 'activate' : '' }}" href="{{route('admin_pen_orders')}}">Pending Orders</a>
                </li>
                  <li class="nav-item">
                  <a class="{{ (request()->is('admin/cancelled_orders')) ? 'activate' : '' }} nav-link" href="{{route('admin_can_orders')}}">Cancelled Orders</a>
                </li>
                </ul>
                </div>
          </li>
            <li class="nav-item {{ (request()->is('payout_req')) ? 'active' : '' }} {{ (request()->is('prv')) ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#payout-dropdown3" aria-expanded="false" aria-controls="setting-dropdown2">
              <i class="menu-icon fa fa-rupee"></i>
              <span class="menu-title">Payout Request/Validation<b class="caret"></b></span>
            </a>
            <div class="collapse {{ (request()->is('payout_req')) ? 'show' : '' }} {{ (request()->is('prv')) ? 'show' : '' }}" id="payout-dropdown3">
              <ul class="nav flex-column sub-menu">
                   <li class="nav-item">
                        <a class="{{ (request()->is('payout_req')) ? 'activate' : '' }} nav-link" href="{{route('pay_req')}}">Payout Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="{{ (request()->is('prv')) ? 'activate' : '' }} nav-link" href="{{route('prv')}}">Payout value validation</a>
                    </li>

                </ul>
                </div>
          </li>
            
            <li class="nav-item {{ (request()->is('RewardList')) ? 'active' : '' }} {{ (request()->is('reedem')) ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#setting-dropdown3" aria-expanded="false" aria-controls="setting-dropdown2">
              <i class="menu-icon fa fa-trophy"></i>
              <span class="menu-title">Reward<b class="caret"></b></span>
            </a>
            <div class="collapse {{ (request()->is('RewardList')) ? 'show' : '' }} {{ (request()->is('reedem')) ? 'show' : '' }}" id="setting-dropdown3">
              <ul class="nav flex-column sub-menu">
                   <li class="nav-item">
                        <a class="nav-link {{ (request()->is('RewardList')) ? 'activate' : '' }}" href="{{route('RewardList')}}">Reward Value</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('reedem')) ? 'activate' : '' }}" href="{{route('reedem')}}">Reedem Value</a>
                    </li>

                </ul>
                </div>
          </li>
            
          </li>
          
          
           <li class="nav-item {{ (request()->is('bannerlist')) ? 'active' : '' }} { (request()->is('secbannerlist')) ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#banner-dropdown" aria-expanded="false" aria-controls="setting-dropdown">
             <i class="material-icons">image</i>
              <span class="menu-title">Banner<b class="caret"></b></span>
            </a>
            <div class="collapse {{ (request()->is('bannerlist')) ? 'show' : '' }} {{ (request()->is('secbannerlist')) ? 'show' : '' }}" id="banner-dropdown">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link {{ (request()->is('bannerlist')) ? 'activate' : '' }}" href="{{route('bannerlist')}}">Main Banner</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ (request()->is('secbannerlist')) ? 'activate' : '' }}" href="{{route('secbannerlist')}}">Secondary Banner</a>
                </li>

                </ul>
                </div>

          </li>
          
    
          <li class="nav-item {{ (request()->is('d_boy/list')) ? 'active' : '' }}">
            <a class="nav-link" href="{{route('d_boylist')}}">
              <i class="material-icons">android</i>
              <p>Delivery Boy</p>
            </a>
          </li>
          
          
          <li class="nav-item {{ (request()->is('couponlist')) ? 'active' : '' }}">
            <a class="nav-link" href="{{route('couponlist')}}">
              <i class="material-icons">view_week</i>
              <p>Coupon</p>
            </a>
          </li>
          <li class="nav-item {{ (request()->is('about_us')) ? 'active' : '' }} {{ (request()->is('terms')) ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#pages-dropdown" aria-expanded="false" aria-controls="setting-dropdown">
              <i class="menu-icon fa fa-calendar"></i>
              <span class="menu-title">Pages<b class="caret"></b></span>
            </a>
            <div class="collapse {{ (request()->is('about_us')) ? 'show' : '' }} {{ (request()->is('terms')) ? 'show' : '' }}" id="pages-dropdown">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link {{ (request()->is('about_us')) ? 'activate' : '' }}" href="{{route('about_us')}}">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ (request()->is('terms')) ? 'activate' : '' }}" href="{{route('terms')}}">Terms & Condition</a>
                </li>

                </ul>
                </div>

          </li>
        </ul>
      </div>
    </div>
  <script>
// Add active class to the current button (highlight it)
var header = document.getElementById("menu");
var btns = header.getElementsByClassName("nav-item");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>