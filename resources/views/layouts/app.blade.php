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
		@stack('css')
    </head>
    <body class="font-sans antialiased">
	<!-- This example requires Tailwind CSS v2.0+ -->
	<div>
		<div class="relative z-40 md:hidden" role="dialog" aria-modal="true">
			<div class="fixed inset-0 bg-gray-300 bg-opacity-75"></div>

			<div class="fixed inset-0 flex z-40">
				<div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-gray-800">
					<div class="absolute top-0 right-0 -mr-12 pt-2">
						<button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
							<span class="sr-only">Close sidebar</span>
							<svg class="h-6 w-6 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
							</svg>
						</button>
					</div>

					<div class="flex-shrink-0 flex items-center px-4">
						<img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg" alt="Workflow">
					</div>
					<div class="mt-5 flex-1 h-0 overflow-y-auto">
						<nav class="px-2 space-y-1">
							<a href="#" class="bg-gray-900 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
								<svg xmlns="http://www.w3.org/2000/svg" class="text-gray-300 mr-4 flex-shrink-0 h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
									<path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
								</svg>
								Settings
							</a>

							<a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
								<!-- Heroicon name: outline/users -->
								<svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
									<path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd" />
								</svg>
								Branding
							</a>

							<a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
								<svg xmlns="http://www.w3.org/2000/svg" class="mr-4 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
									<path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
								</svg>
								Plans
							</a>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
			<div class="flex flex-col flex-grow pt-5 bg-gray-800 overflow-y-auto">
				<div class="flex items-center flex-shrink-0 px-4">
					<img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg" alt="Workflow">
				</div>
				<div class="mt-5 flex-1 flex flex-col">
					<nav class="flex-1 px-2 pb-4 space-y-1">
						<a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'bg-gray-900 text-white text-base font-medium' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-base font-medium rounded-md">
							<svg xmlns="http://www.w3.org/2000/svg" class="{{ request()->routeIs('settings') ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300'}} mr-4 flex-shrink-0 h-6 w-6"
								 viewBox="0 0 20 20" fill="currentColor">
								<path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
							</svg>
							Settings
						</a>

						<a href="{{ route('branding') }}" class="{{ request()->routeIs('branding') ? 'bg-gray-900 text-white text-base font-medium' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} group flex items-center px-2 py-2 text-base font-medium rounded-md">
							<svg xmlns="http://www.w3.org/2000/svg" class="{{ request()->routeIs('branding') ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300'}} mr-4 flex-shrink-0 h-6 w-6" fill="currentColor">
								<path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd" />
							</svg>
							Branding
						</a>

						<a href="{{ route('plans') }}" class="{{ request()->routeIs('plans') ? 'bg-gray-900 text-white text-base font-medium' : 'text-gray-300 hover:bg-gray-700 hover:text-white'
						 }} group flex items-center px-2 py-2 text-base font-medium rounded-md">
							<svg xmlns="http://www.w3.org/2000/svg" class="{{ request()->routeIs('branding') ? 'text-gray-300' : 'text-gray-400 group-hover:text-gray-300'}} mr-4 flex-shrink-0 h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
								<path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
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
