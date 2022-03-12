<!DOCTYPE html>
<html lang="en" data-theme="djp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <title>KPP 073</title>
    @livewireStyles
    @stack('styles')



</head>
<body>

    <x-pesan />
    <div class="h-screen drawer drawer-mobile w-full">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle">
        <div class="drawer-content self-start p-8">
            <!-- Page content here -->
            <label for="my-drawer-2" class="fixed top-8 left-8 bg-primary z-50 cursor-pointer opacity-80 p-4 rounded-full drawer-button lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-content" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                </svg>
            </label>
            @yield('app')
        </div>
        <div class="drawer-side">
            <label for="my-drawer-2" class="drawer-overlay"></label>
            <div class="p-4 w-80 bg-base-200">
                @stack('sidebar')
            </div>
        </div>
        </div>

    @livewireScripts
    <script defer src="{{ mix('js/app.js') }}"></script>
    @stack('chart')
    @stack('scripts')

</body>
</html>
