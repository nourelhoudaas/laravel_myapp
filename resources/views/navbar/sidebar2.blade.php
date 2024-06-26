

<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
               <i class="lni lni-grid-alt"></i>
            </button>
            <div class="sidebar-logo" >
               <a href="#"><img src="{{ asset('assets/main/img/logo_ministere.svg')}}" class="img-thumbnail"  alt="..."></a>
           </div>
        </div>

        <ul class="sidebar-nav">
           <li class="sidebar-item">
               <a href="{{route('app_dashboard')}}" class="sidebar-link @if(Request::route()->getName()=='app_dashboard') active @endif">
                   <i class="lni lni-user"></i>
                   <span>Dashboard</span>
               </a>
           </li>

           <li class="sidebar-item">
               <a href="{{route('app_dashboard')}}" class="sidebar-link collapsed has-dropdown @if(Request::route()->getName()=='app_dashboard') active @endif" data-bs-toggle="collapse"
                   data-bs-target="#dir" aria-expanded="false" aria-controls="auth">
                   <i class="lni lni-protection"></i>
                   <span>Directions</span>
               </a>
               <ul id="dir" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                   <li class="sidebar-item">
                       <a href="{{route('app_dashboard')}}" class="sidebar-link">Direction une</a>
                   </li>
                   <li class="sidebar-item">
                       <a href="{{route('app_dashboard')}}" class="sidebar-link">Direction deux</a>
                   </li>
               </ul>
           </li>

           <li class="sidebar-item">
               <a href="{{route('app_liste_emply')}}" class="sidebar-link collapsed has-dropdown @if(Request::route()->getName()=='app_liste_emply') active @endif" data-bs-toggle="collapse"
                   data-bs-target="#emp" aria-expanded="false" aria-controls="auth">
                   <i class="lni lni-protection"></i>
                   <span>Employees</span>
               </a>
               <ul id="emp" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                   <li class="sidebar-item">
                       <a href="{{route('app_liste_emply')}}" class="sidebar-link  @if(Request::route()->getName()=='app_liste_emply') active @endif">List Employees</a>
                   </li>
                   <li class="sidebar-item">
                        <a href="{{route('app_add_emply')}}" class="sidebar-link  @if(Request::route()->getName()=='app_add_emply') active @endif">Add Employee</a>
                   </li>
               </ul>
           </li>

           <li class="sidebar-item">
               <a href="#" class="sidebar-link">
                   <i class="lni lni-popup"></i>
                   <span>Notification</span>
               </a>
           </li>

           <li class="sidebar-item">
               <a href="#" class="sidebar-link">
                   <i class="lni lni-agenda"></i>
                   <span>Task</span>
               </a>
           </li>

           <li class="sidebar-item">
               <a href="#" class="sidebar-link">
                   <i class="lni lni-cog"></i>
                   <span>Setting</span>
               </a>
           </li>
       </ul>
    </aside>
    <div class="main">
         @include('navbar.navbar')
        {{-- <main class="content px-3 py-4">
            <div class="container-fluid">
                <div class="mb-3">
                    <h3 class="fw-bold fs-4 mb-3">Admin Dashboard</h3>
                    <div class="row">
                        <div class="col-12 col-md-4 ">
                            <div class="card border-0">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Memebers Progress
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        $72,540
                                    </p>
                                    <div class="mb-0">
                                        <span class="badge text-success me-2">
                                            +9.0%
                                        </span>
                                        <span class=" fw-bold">
                                            Since Last Month
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 ">
                            <div class="card  border-0">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Memebers Progress
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        $72,540
                                    </p>
                                    <div class="mb-0">
                                        <span class="badge text-success me-2">
                                            +9.0%
                                        </span>
                                        <span class="fw-bold">
                                            Since Last Month
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 ">
                            <div class="card border-0">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Memebers Progress
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        $72,540
                                    </p>
                                    <div class="mb-0">
                                        <span class="badge text-success me-2">
                                            +9.0%
                                        </span>
                                        <span class="fw-bold">
                                            Since Last Month
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="fw-bold fs-4 my-3">Avg. Agent Earnings
                    </h3>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="highlight">
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main> --}}
    </div>
</div>


{{-- **********************STYLE********************************* --}}

::after,
::before {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

a {
    text-decoration: none;
}

li {
    list-style: none;
}

body {
    font-family: 'Poppins', sans-serif;
}

.wrapper {
    display: flex;
}

.main {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    width: 100%;
    overflow: hidden;
    transition: all 0.35s ease-in-out;
    background-color: #fff;
    min-width: 0;
}

#sidebar {
    width: 70px;
    min-width: 70px;
    z-index: 1000;
    transition: all .25s ease-in-out;
    background-color: #0e2238;
    display: flex;
    flex-direction: column;
}

#sidebar.expand {
    width: 260px;
    min-width: 260px;
}

 .toggle-btn {
    background-color: transparent;
    cursor: pointer;
    border: 0;
    padding: 1rem 1.5rem;
}

.toggle-btn i {
    font-size: 1.5rem;
    color: #FFF;
}

.sidebar-logo {
    margin: auto 0;
}

.sidebar-logo a {
    color: #FFF;
    font-size: 1.15rem;
    font-weight: 600;
}

#sidebar:not(.expand) .sidebar-logo,
#sidebar:not(.expand) a.sidebar-link span {
    display: none;
}

#sidebar.expand .sidebar-logo,
#sidebar.expand a.sidebar-link span {
    animation: fadeIn .25s ease;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}

.sidebar-nav {
    padding: 2rem 0;
    flex: 1 1 auto;
}

a.sidebar-link {
    padding: .625rem 1.625rem;
    color: #FFF;
    display: block;
    font-size: 0.9rem;
    white-space: nowrap;
    border-left: 3px solid transparent;
}

.sidebar-link i,
.dropdown-item i {
    font-size: 1.1rem;
    margin-right: .75rem;
}

a.sidebar-link:hover {
    background-color: rgba(255, 255, 255, .075);
    border-left: 3px solid #3b7ddd;
}

.sidebar-item {
    position: relative;
}

#sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
    position: absolute;
    top: 0;
    left: 70px;
    background-color: #0e2238;
    padding: 0;
    min-width: 15rem;
    display: none;
}

#sidebar:not(.expand) .sidebar-item:hover .has-dropdown+.sidebar-dropdown {
    display: block;
    max-height: 15em;
    width: 100%;
    opacity: 1;
}

#sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
    border: solid;
    border-width: 0 .075rem .075rem 0;
    content: "";
    display: inline-block;
    padding: 2px;
    position: absolute;
    right: 1.5rem;
    top: 1.4rem;
    transform: rotate(-135deg);
    transition: all .2s ease-out;
}

#sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
    transform: rotate(45deg);
    transition: all .2s ease-out;
}

.navbar {
    background-color: #f5f5f5;
    box-shadow: 0 0 2rem 0 rgba(33, 37, 41, .1);
}

.navbar-expand .navbar-collapse {
    min-width: 200px;
}

.avatar {
    height: 40px;
    width: 40px;
}



@media (min-width: 768px) {}
{{-- ********************************************************************************** --}}
