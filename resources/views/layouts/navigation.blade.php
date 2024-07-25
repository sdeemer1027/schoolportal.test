<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .image-map-container {
            position: relative;
            display: inline-block;
            width: 650px;
            height: 514px;
        }

        .image-map-container img {
            width: 650px;
            height: 514px;
            display: block;
        }

        .highlight {
            position: absolute;
            background: rgba(128, 128, 128, 0.1); /* Gray with some transparency */
            transition: background 0.3s ease;
        }

        /* Define the positions and sizes of the highlights */
        .highlight-homeroom { top: 394px; left: 509px; width: 68px; height: 64px; }
        .highlight-firstperiod { top: 392px; left: 408px; width: 66px; height: 68px; }
        .highlight-secondperiod { top: 311px; left: 412px; width: 62px; height: 73px; }
        .highlight-thirdperiod { top: 311px; left: 506px; width: 67px; height: 75px; }
        .highlight-fourthperiod { top: 238px; left: 505px; width: 67px; height: 67px; }
        .highlight-finalperiod { top: 240px; left: 414px; width: 56px; height: 64px; }
        .highlight-bathroombreak { top: 51px; left: 60px; width: 149px; height: 71px; }
        .highlight-mainoffice { top: 203px; left: 30px; width: 91px; height: 68px; }
        .highlight-mutimedia1 { top: 52px; left: 360px; width: 69px; height: 71px; }
        .highlight-mutimedia2 { top: 52px; left: 439px; width: 70px; height: 68px; }
        .highlight-break { top: 50px; left: 218px; width: 32px; height: 77px; }
        .highlight-counsil { top: 50px; left: 253px; width: 27px; height: 73px; }
        .highlight-medical { top: 48px; left: 288px; width: 27px; height: 74px; }
        .highlight-art { top: 88px; left: 519px; width: 72px; height: 83px; }
        .highlight-music { top: 114px; left: 557px; width: 63px; height: 94px; }
        .highlight-gym { top: 148px; left: 357px; width: 165px; height: 60px; }
        .highlight-lunch { top: 154px; left: 150px; width: 108px; height: 118px; }

        /* Hover effect */
        .highlight:hover {
            background: rgba(128, 128, 128, 0.7); /* Darker gray on hover */
        }
    </style>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
<x-nav-link   href="#" data-toggle="modal" data-target="#schoolModal">
                        School
                    </x-nav-link>
{{--


<x-nav-link :href="#" data-toggle="modal" data-target="#schoolModal" >
    {{ __('School') }}
</x-nav-link>

--}}

                                    </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                   @if (auth()->user()->hasRole('teacher'))
                   {{-- could be a menu for teacher --}}
                    <x-dropdown-link :href="route('teacher.classroom')">
                            {{ __('Classroom') }}
                            </x-dropdown-link>
                    @endif




                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                   @if (auth()->user()->hasRole('teacher'))
                   {{-- could be a menu for teacher --}}
                    <x-dropdown-link :href="route('teacher.classroom')">
                            {{ __('Classroom') }}
                            </x-dropdown-link>
                    @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="schoolModal" tabindex="-1" role="dialog" aria-labelledby="schoolModalLabel" aria-hidden="true">


    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="schoolModalLabel">School Layout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="image-map-container">
                    <img src="/img/school-layout.png" usemap="#image-map">
                    <!-- Overlay divs -->
                    <a href="{{route('homeroom')}}" class="highlight highlight-homeroom"></a>
                    <a href="firstperiod.blade.php" class="highlight highlight-firstperiod"></a>
                    <a href="secondperiod.blade.php" class="highlight highlight-secondperiod"></a>
                    <a href="thirdperiod.blade.php" class="highlight highlight-thirdperiod"></a>
                    <a href="fourthperiod.blade.php" class="highlight highlight-fourthperiod"></a>
                    <a href="5period" class="highlight highlight-finalperiod"></a>
                    <a href="bathroom" class="highlight highlight-bathroombreak"></a>
                    <a href="office" class="highlight highlight-mainoffice"></a>
                    <a href="mutimedia1" class="highlight highlight-mutimedia1"></a>
                    <a href="mutimedia2" class="highlight highlight-mutimedia2"></a>
                    <a href="break" class="highlight highlight-break"></a>
                    <a href="counsil" class="highlight highlight-counsil"></a>
                    <a href="medical" class="highlight highlight-medical"></a>
                    <a href="art" class="highlight highlight-art"></a>
                    <a href="music" class="highlight highlight-music"></a>
                    <a href="gym" class="highlight highlight-gym"></a>
                    <a href="lunch" class="highlight highlight-lunch"></a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
