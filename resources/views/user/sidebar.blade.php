<ul class="collection with-header">

        <li class="collection-header center">
            <div class="m-t-10">
                <img src="{{Storage::url('users/'.auth()->user()->image)}}" alt="{{ auth()->user()->name }}" class="circle responsive-img">
            </div>
            <h5 class="truncate">
                {{ auth()->user()->name }}
            </h5>
            <h6 class="m-t-0"><small>{{ auth()->user()->email }}</small></h6>
        </li>
    
        <a href="{{ route('user.dashboard') }}">
            <li class="collection-item {{ Request::is('user/dashboard') ? 'active' : '' }}">
                <i class="material-icons left">dashboard</i>
                <span>Dashboard<span>
            </li>
        </a>
    
        <a href="{{ route('user.profile') }}">
            <li class="collection-item {{ Request::is('user/profile') ? 'active' : '' }}">
                <i class="material-icons left">person</i>
                <span>Profile</span>
            </li>
        </a>
        <a href="{{ route('user.message') }}">
            <li class="collection-item {{ Request::is('user/message*') ? 'active' : '' }}">
                <i class="material-icons left">mail</i>
                <span>Messages</span>
            </li>
        </a>
        <a href="{{ route('user.changepassword') }}">
            <li class="collection-item {{ Request::is('user/changepassword') ? 'active' : '' }}">
                <i class="material-icons left">lock</i>
                <span>Change Password</span>
            </li>
        </a>
    
    </ul>