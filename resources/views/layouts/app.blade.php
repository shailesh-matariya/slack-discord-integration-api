<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
	<div>
		<div class="relative z-40 md:hidden" role="dialog" aria-modal="true">
			<div class="fixed inset-0 bg-gray-300 bg-opacity-75"></div>

			<div class="fixed inset-0 flex z-40">
				<div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-gray-50">
					<div class="absolute top-0 right-0 -mr-12 pt-2">
						<button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
							<span class="sr-only">Close sidebar</span>
							<svg class="h-6 w-6 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
							</svg>
						</button>
					</div>

					<div class="flex-shrink-0 flex items-center px-4">
						<img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-300-mark-white-text.svg" alt="Workflow">
					</div>
					<div class="mt-5 flex-1 h-0 overflow-y-auto">
						<nav class="px-2 space-y-1">
							<a href="#" class="bg-gray-300 group flex items-center px-2 py-2 text-base font-bold rounded-md">
								<svg class="mr-4 flex-shrink-0 h-6 w-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
								</svg>
								Settings
							</a>

							<a href="#" class=" hover:bg-gray-200 group flex items-center px-2 py-2 text-base font-bold rounded-md">
								<!-- Heroicon name: outline/users -->
								<svg class="mr-4 flex-shrink-0 h-6 w-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
								</svg>
								Branding
							</a>

							<a href="#" class=" hover:bg-gray-200 group flex items-center px-2 py-2 text-base font-bold rounded-md">
								<svg class="mr-4 flex-shrink-0 h-6 w-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
								</svg>
								Plans
							</a>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
			<div class="flex flex-col flex-grow pt-5 bg-gray-50 overflow-y-auto">
				<div class="flex items-center flex-shrink-0 px-4">
					<img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-300-mark-white-text.svg" alt="Workflow">
				</div>
				<div class="mt-5 flex-1 flex flex-col">
					<nav class="flex-1 px-2 pb-4 space-y-1">
						<a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'bg-gray-200' : 'hover:bg-gray-200' }} group flex items-center px-2 py-2 text-sm font-bold
						rounded-md">
							<svg class="mr-3 flex-shrink-0 h-6 w-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
							</svg>
							Settings
						</a>

						<a href="{{ route('branding') }}" class="{{ request()->routeIs('branding') ? 'bg-gray-200' : 'hover:bg-gray-200' }} group flex items-center px-2 py-2 text-sm font-bold rounded-md">
							<svg class="mr-3 flex-shrink-0 h-6 w-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
							</svg>
							Branding
						</a>

						<a href="{{ route('plans') }}" class="{{ request()->routeIs('plans') ? 'bg-gray-200' : 'hover:bg-gray-200' }} group flex items-center px-2 py-2 text-sm font-bold rounded-md">
							<svg class="mr-3 flex-shrink-0 h-6 w-6 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
							</svg>
							Plans
						</a>
					</nav>
				</div>
			</div>
		</div>
		<div class="md:pl-64 flex flex-col flex-1">
			<main>
				{{ $slot }}
			</main>
		</div>
	</div>
        @livewireScripts
    </body>
</html>
