<x-app-layout>
	<div class="max-w-4xl mx-auto flex flex-col md:px-8 xl:px-0">
		<div class="py-10">
			<div class="max-w-4xl mx-auto px-4">
				<div class="py-6">
					<div class="mx-auto">
						<div class="sm:flex sm:flex-col sm:align-center">
							<h1 class="text-5xl font-extrabold text-gray-900 sm:text-center">Pricing Plans</h1>
							<p class="mt-5 text-xl text-gray-500 sm:text-center">Start using for free.<br>Paid plans unlock additional features.</p>
						</div>
						<div class="mt-12 space-y-4 sm:mt-16 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-6 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:mx-0 xl:grid-cols-2">
							<div class="border-solid border-1 border border-gray-200 rounded-lg shadow-lg">
								<div class="p-6 border-0">
									<h2 class="text-lg leading-6 font-medium text-gray-900">Free edition</h2>
									<p class="mt-4 text-sm text-gray-500">Great for non profits and open source communities</p>
									<p class="mt-8"></p>
                                    @if($subscribed)
                                        <button @if($onGracePeriod) disabled @endif  class="shadow-sm mt-8 block w-full bg-blue-500 border border-blue-500 rounded-md py-2 text-sm font-semibold text-white text-center disabled:opacity-50 "
                                                @if(!$onGracePeriod) href="{{route('subscribe.cancel')}} @endif"
                                        >
                                            Back to free plan
                                        </button>
                                    @else
                                        <a class="shadow-sm mt-8 block w-full bg-green-500 border border-green-500 rounded-md py-2 text-sm font-semibold text-white text-center">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check inline-block h-4 ml-1" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
                                            </svg>
                                        </a>
                                    @endif
								</div>

								<div class="pt-6 pb-8 px-6">
									<h3 class="text-xs font-medium text-gray-900 tracking-wide uppercase">What's included</h3>
									<ul role="list" class="mt-6 space-y-4">
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Hosting on Linen.dev domain</span>
										</li>
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Sync Discord or Slack community</span>
										</li>
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Anonymize community members</span>
										</li>
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Unlimited message retention history</span>
										</li>
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Show or hide channels</span>
										</li>
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Custom community invite URL</span>
										</li>
									</ul>
								</div>
							</div>
							<div class="border-solid border-1 border border-gray-200 rounded-lg shadow-lg">
								<div class="p-6">
									<h2 class="text-lg leading-6 font-medium text-gray-900">Premium</h2>
									<p class="mt-4 text-sm text-gray-500">Built for companies</p><p class="mt-8"></p>
                                    @if($subscribed)
                                        <a class="shadow-sm mt-8 block w-full bg-green-500 border border-green-500 rounded-md py-2 text-sm font-semibold text-white text-center hover:bg-green-600">
                                            $100 USD/month Subscribed
                                            @if($onGracePeriod)
                                                <br> Your subscription will cancel on {{$onGracePeriod->ends_at->format('Y-m-d')}}
                                            @endif
                                        </a>
                                    @else
                                        <a class="shadow-sm mt-8 block w-full bg-blue-500 border border-blue-500 rounded-md py-2 text-sm font-semibold text-white text-center hover:bg-blue-600"
                                           href="{{route('subscribe.checkout')}}">
                                            $100 USD/month
                                        </a>
                                    @endif
								</div>
								<div class="pt-6 pb-8 px-6">
									<h3 class="text-xs font-medium text-gray-900 tracking-wide uppercase">What's included</h3>
									<ul role="list" class="mt-6 space-y-4">
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Custom domain</span>
										</li>
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Generate SEO from organic content</span>
										</li>
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Google analytics support</span>
										</li>
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Custom logo</span>
										</li>
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Custom brand colors</span>
										</li>
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Priority Support</span>
										</li>
										<li class="flex space-x-3">
											<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check flex-shrink-0 h-5 w-5 text-green-500" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
												<path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
											</svg>
											<span class="text-sm text-gray-500">Generated sitemap to improve SEO</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
