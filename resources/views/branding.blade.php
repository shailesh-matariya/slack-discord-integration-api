<x-app-layout>
	<div class="max-w-4xl mx-auto flex flex-col md:px-8 xl:px-0">
		<div class="py-10">
			<div class="max-w-4xl mx-auto px-4">
				<h1 class="text-3xl font-extrabold text-gray-900">Branding</h1>
				<div class="py-6">
					<form action="#">
						<div class="grid grid-cols-1">
							<div class="flex flex-col">
								<div class="p-3 mb-3 rounded border-gray-200 border-solid border bg-slate-50">
									<label for="redirectDomain" class="block text-sm font-bold leading-5 mb-1">Redirect Domain</label>
									<div class="text-sm mb-2 text-gray-600">Unique domain to redirect to.</div>
									<div class="mt-1 relative rounded-md shadow-sm">
										<input type="text" name="company-website" id="company-website" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="www.example.com">
									</div>
								</div>
								<div class="p-3 mb-3 rounded border-gray-200 border-solid border bg-slate-50">
									<label for="brandColor" class="block text-sm font-bold leading-5 mb-1">Brand Color</label>
									<div class="text-sm mb-2 text-gray-600">Color that matches your brand. We'll use it for the header background.</div>
									<div class="mt-1 relative rounded-md shadow-sm">
										<input type="color" name="brand-color" id="brandColor" class="h-9 py-0 px-0.5 bg-white focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm
										border-gray-300 rounded-md" value="#E2E2E2">
									</div>
								</div>
								<div class="p-3 mb-3 rounded border-gray-200 border-solid border bg-slate-50">
									<label for="logo" class="block text-sm font-bold leading-5 mb-1">Logo</label>
									<div class="text-sm mb-2 text-gray-600">Logo of your brand.</div>
									<input type="file" style="display:none">
									<button disabled="" type="button" class="font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:ring-4 focus:outline-none text-black bg-gray-200">Upload file</button>
								</div>
								<div class="p-3 mb-3 rounded border-gray-200 border-solid border bg-slate-50">
									<label for="googleAnalyticsId" class="block text-sm font-bold leading-5 mb-1">Google Analytics ID</label>
									<div class="text-sm mb-2 text-gray-600">You can collect data from your website with Google Analytics. <br/>Enter a valid Analytics Property ID.</div>
									<div class="mt-1 relative rounded-md shadow-sm">
										<input type="text" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" id="googleAnalyticsId"
											   name="googleAnalyticsId" placeholder="G-XXXXXXX or UA-XXXXXX-X" disabled="" readonly="" value="">
									</div>
								</div>
								<div class="flex justify-end">
									<button type="button" class="font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:ring-4 focus:outline-none text-white bg-yellow-600 hover:bg-yellow-500 focus:ring-yellow-600">Upgrade your account</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
