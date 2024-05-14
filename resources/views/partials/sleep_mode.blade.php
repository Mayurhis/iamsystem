<div class="sleep-wrapper" id="timeout-screen" style="display:none;">
   <div class="sleep-wrapper__thumb"> 
      <img class="" src="{{ asset('backend/images/sleep-img.jpg') }}" alt="@lang('Sleep')">
   </div>
   <form class='form'>
      <div class="avatar">
         <div class="avatar__icon"><img src="{{ asset('backend/images/userlogo.svg') }}" alt="@lang('User')"></div>
         <div class="avatar__content">
            <h5 class="avatar__title">User</h5>
            <button class="sleep__button" type="submit">Continue</button>
         </div>
      </div>
   </form>
   <div class="sleep-bottom">
      <div class="sleep-bottom__time">
         <div id="countdown" class="clock"></div>
      </div>
      <div class="sleep-bottom__menu btn-group dropup">
         <button type="button" class="sleep-bottom-menu__button dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <img src="{{ asset('backend/images/home.svg') }}" alt="@lang('Home')">
         </button>
         <div class="sleep-bottom-dropdown dropdown-menu" x-placement="top-start">
            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                <span class="dropdown-item__icon"><i class="fas fa-home"></i></span> @lang('Home')
            </a>
            <a class="dropdown-item logoutBtn" id="sleep_logoutBtn" href="{{ route('logout') }}">
                <span class="dropdown-item__icon"><i class="fas fa-sign-out-alt"></i></span> @lang('Log Out')
            </a>
         </div> 
      </div>
   </div>
</div>