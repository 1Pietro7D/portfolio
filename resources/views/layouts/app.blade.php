<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('../fragments.meta-head')
    </head>
    <body>

    <div class="bo-container">

        {{-- start left-section --}}
        <div class="bo-left-section">
            @include('../fragments.dashboard')
        </div>
        {{-- end left-section --}}

        {{-- start divider --}}
        <div class="divider"></div>
        {{-- end divider --}}

        {{-- start right-section --}}
        <div class="bo-right-section">
            <header class="bo-header p-4">
                @include('../fragments.header-nav')
            </header>
            <main class="bo-main">
                @yield('content')
            </main>
        </div>
        {{-- end right-section --}}

      </div>
    </body>
</html>
