<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"
				integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

        <!-- Styles -->
        @livewireStyles
		@stack('css')
    </head>
    <body class="font-sans antialiased">
	<!-- This example requires Tailwind CSS v2.0+ -->
	<header class="bg-gray-800">
		<nav class="mx-auto px-4 sm:px-6 lg:px-8" aria-label="Top">
			<div class="flex w-full items-center justify-between border-b border-indigo-500 py-6 lg:border-none">
				<div class="flex items-center">
					<div class="flex-shrink-0 flex items-center px-4">
						<img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-600-mark-gray-800-text.svg" alt="Workflow">
					</div>
					<div class="ml-10 hidden space-x-8 lg:block">
						<a
							href="{{ route('settings') }}"
							class="{{ request()->routeIs('settings') ? 'text-white' : 'text-gray-400 hover:text-gray-700 hover:text-white'}} text-base font-medium"
						>
							Settings
						</a>
						<a
							href="{{ route('branding') }}"
							class="{{ request()->routeIs('branding') ? 'text-white' : 'text-gray-400 hover:text-gray-700 hover:text-white'}} text-base font-medium"
						>
							Branding
						</a>
						<a
							href="{{ route('plans') }}"
							class="{{ request()->routeIs('plans') ? 'text-white' : 'text-gray-400 hover:text-gray-700 hover:text-white'}} text-base font-medium"
						>
							Plans
						</a>
					</div>
				</div>
			</div>
			<div class="flex flex-wrap justify-center space-x-6 py-4 lg:hidden">
				<a
					href="{{ route('settings') }}"
					class="{{ request()->routeIs('settings') ? 'text-white' : 'text-gray-400 hover:text-gray-700 hover:text-white'}} text-base font-medium"
				>
					Settings
				</a>
				<a
					href="{{ route('branding') }}"
					class="{{ request()->routeIs('branding') ? 'text-white' : 'text-gray-400 hover:text-gray-700 hover:text-white'}} text-base font-medium"
				>
					Branding
				</a>
				<a
					href="{{ route('plans') }}"
					class="{{ request()->routeIs('plans') ? 'text-white' : 'text-gray-400 hover:text-gray-700 hover:text-white'}} text-base font-medium"
				>
					Plans
				</a>
			</div>
		</nav>
	</header>

	<!-- This example requires Tailwind CSS v2.0+ -->
	<div>
		<div class="flex flex-col flex-1 bg-slate-50">
			<main>
				{{ $slot }}
			</main>
		</div>
	</div>
        @livewireScripts
    </body>
</html>
