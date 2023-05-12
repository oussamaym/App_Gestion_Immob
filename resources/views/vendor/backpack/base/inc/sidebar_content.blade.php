{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-users la-lg mt-4"></i> Users</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('bien') }}"><i class="nav-icon la la-building la-lg mt-4"></i> Biens</a></li>