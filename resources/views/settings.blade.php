<x-app-layout>
	<div class="max-w-4xl mx-auto flex flex-col md:px-8 xl:px-0">
		<div class="py-10">
			<div class="max-w-4xl mx-auto px-4">
				<h1 class="text-3xl font-extrabold text-gray-900">Settings</h1>
				<div class="ph-6">
					<div class="grid grid-cols-1 gap-4">
						<div class="grid grid-cols-1 divide-y divide-gray-200 divide-solid">
							<div class="bg-white">
								<div class="px-4 py-5 sm:p-6">
									<div class="flex">
										<div class="grow">
											<h3 class="text-lg leading-6 font-medium text-gray-900">
												Slack integration
												@if ($account)
												<span class="text-gray-300"> | </span>
												<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check h-5 w-5 mr-1 inline"
													 role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" color="green"><path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path></svg>	Done
												@endif
											</h3>
											<div class="mt-2 sm:flex sm:items-start sm:justify-between">
												<div class="max-w-xl text-sm text-gray-500">
													<p>Connect to Slack to fetch conversation.</p>
												</div>
											</div>
										</div>

										<div class="flex flex-col items-center gap-2">
											@if (! $account || $account->platform === 'slack')
											<a href="{{ $slackUrl }}" class="flex rounded-md border p-2 justify-around border-gray-300 text-base">
												<div class="flex gap-2 items-center">
													<svg width="20" height="20" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg">
														<g fill="none" fill-rule="evenodd">
															<path d="M19.712.133a5.381 5.381 0 0 0-5.376 5.387 5.381 5.381 0 0 0 5.376 5.386h5.376V5.52A5.381 5.381 0 0 0 19.712.133m0 14.365H5.376A5.381 5.381 0 0 0 0 19.884a5.381 5.381 0 0 0 5.376 5.387h14.336a5.381 5.381 0 0 0 5.376-5.387 5.381 5.381 0 0 0-5.376-5.386" fill="#36C5F0"></path>
															<path d="M53.76 19.884a5.381 5.381 0 0 0-5.376-5.386 5.381 5.381 0 0 0-5.376 5.386v5.387h5.376a5.381 5.381 0 0 0 5.376-5.387m-14.336 0V5.52A5.381 5.381 0 0 0 34.048.133a5.381 5.381 0 0 0-5.376 5.387v14.364a5.381 5.381 0 0 0 5.376 5.387 5.381 5.381 0 0 0 5.376-5.387" fill="#2EB67D"></path>
															<path d="M34.048 54a5.381 5.381 0 0 0 5.376-5.387 5.381 5.381 0 0 0-5.376-5.386h-5.376v5.386A5.381 5.381 0 0 0 34.048 54m0-14.365h14.336a5.381 5.381 0 0 0 5.376-5.386 5.381 5.381 0 0 0-5.376-5.387H34.048a5.381 5.381 0 0 0-5.376 5.387 5.381 5.381 0 0 0 5.376 5.386" fill="#ECB22E"></path>
															<path d="M0 34.249a5.381 5.381 0 0 0 5.376 5.386 5.381 5.381 0 0 0 5.376-5.386v-5.387H5.376A5.381 5.381 0 0 0 0 34.25m14.336-.001v14.364A5.381 5.381 0 0 0 19.712 54a5.381 5.381 0 0 0 5.376-5.387V34.25a5.381 5.381 0 0 0-5.376-5.387 5.381 5.381 0 0 0-5.376 5.387" fill="#E01E5A"></path>
														</g>
													</svg>
													@if (! $account)
													<p class="whitespace-nowrap">Connect to Slack</p>
													@else
													<p class="whitespace-nowrap">Reconnect to Slack</p>
													@endif
												</div>
											</a>
											@endif

											@if (! $account || $account->platform === 'discord')
											<a href="{{ $discordUrl }}" class="flex rounded-md border p-2 justify-around border-gray-300 text-base">
												<div class="flex gap-2 items-center">
													<svg width="20" height="20" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg">
														<g fill="none" fill-rule="evenodd">
															<path d="M19.712.133a5.381 5.381 0 0 0-5.376 5.387 5.381 5.381 0 0 0 5.376 5.386h5.376V5.52A5.381 5.381 0 0 0 19.712.133m0 14.365H5.376A5.381 5.381 0 0 0 0 19.884a5.381 5.381 0 0 0 5.376 5.387h14.336a5.381 5.381 0 0 0 5.376-5.387 5.381 5.381 0 0 0-5.376-5.386" fill="#36C5F0"></path>
															<path d="M53.76 19.884a5.381 5.381 0 0 0-5.376-5.386 5.381 5.381 0 0 0-5.376 5.386v5.387h5.376a5.381 5.381 0 0 0 5.376-5.387m-14.336 0V5.52A5.381 5.381 0 0 0 34.048.133a5.381 5.381 0 0 0-5.376 5.387v14.364a5.381 5.381 0 0 0 5.376 5.387 5.381 5.381 0 0 0 5.376-5.387" fill="#2EB67D"></path>
															<path d="M34.048 54a5.381 5.381 0 0 0 5.376-5.387 5.381 5.381 0 0 0-5.376-5.386h-5.376v5.386A5.381 5.381 0 0 0 34.048 54m0-14.365h14.336a5.381 5.381 0 0 0 5.376-5.386 5.381 5.381 0 0 0-5.376-5.387H34.048a5.381 5.381 0 0 0-5.376 5.387 5.381 5.381 0 0 0 5.376 5.386" fill="#ECB22E"></path>
															<path d="M0 34.249a5.381 5.381 0 0 0 5.376 5.386 5.381 5.381 0 0 0 5.376-5.386v-5.387H5.376A5.381 5.381 0 0 0 0 34.25m14.336-.001v14.364A5.381 5.381 0 0 0 19.712 54a5.381 5.381 0 0 0 5.376-5.387V34.25a5.381 5.381 0 0 0-5.376-5.387 5.381 5.381 0 0 0-5.376 5.387" fill="#E01E5A"></path>
														</g>
													</svg>
													@if (! $account)
														<p class="whitespace-nowrap">Connect to Discord</p>
													@else
														<p class="whitespace-nowrap">Reconnect to Discord</p>
													@endif
												</div>
											</a>
											@endif
										</div>
									</div>
								</div>
							</div>
							<div class="bg-white">
								<div class="px-4 py-5 sm:p-6">
									<div class="flex">
										<div class="grow">
											<h3 class="text-lg leading-6 font-medium text-gray-900" id="headlessui-label-1">Anonymize your users</h3>
											<div class="mt-2 sm:flex sm:items-start sm:justify-between">
												<div class="max-w-xl text-sm text-gray-500">
													<p id="headlessui-description-2">Replace your community member's display name and profile images with randomly generated words.</p>
												</div>
											</div>
										</div>

										<div class="self-center">
											<div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
												<button class="bg-gray-200 relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300" id="headlessui-switch-3" role="switch" type="button" tabindex="0" aria-checked="false" aria-labelledby="headlessui-label-1" aria-describedby="headlessui-description-2">
													<span class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="bg-white">
								<div class="px-4 py-5 sm:p-6">
									<div class="flex">
										<div class="grow">
											<h3 class="text-lg leading-6 font-medium text-gray-900">Default channel</h3>
											<div class="mt-2 sm:flex sm:items-start sm:justify-between">
												<div class="max-w-xl text-sm text-gray-500">
													<p>Select the first channel that gets displayed when a user lands on your Linen page.</p>
												</div>
											</div>
										</div>

										<div class="self-center">
											<label class="sr-only" id="headlessui-listbox-label-4">Change published status</label>
											<div class="relative">
												<div class="inline-flex shadow-sm rounded-md divide-x divide-blue-700">
													<div class="relative z-0 inline-flex shadow-sm rounded-md divide-x divide-blue-700">
														<div class="relative inline-flex items-center bg-blue-700 py-2 pl-3 pr-4 border border-transparent rounded-l-md shadow-sm text-white">
															<svg width="14px" height="14px" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg">
																<g fill="none" fill-rule="evenodd">
																	<path d="M19.712.133a5.381 5.381 0 0 0-5.376 5.387 5.381 5.381 0 0 0 5.376 5.386h5.376V5.52A5.381 5.381 0 0 0 19.712.133m0 14.365H5.376A5.381 5.381 0 0 0 0 19.884a5.381 5.381 0 0 0 5.376 5.387h14.336a5.381 5.381 0 0 0 5.376-5.387 5.381 5.381 0 0 0-5.376-5.386" fill="#eee"></path>
																	<path d="M53.76 19.884a5.381 5.381 0 0 0-5.376-5.386 5.381 5.381 0 0 0-5.376 5.386v5.387h5.376a5.381 5.381 0 0 0 5.376-5.387m-14.336 0V5.52A5.381 5.381 0 0 0 34.048.133a5.381 5.381 0 0 0-5.376 5.387v14.364a5.381 5.381 0 0 0 5.376 5.387 5.381 5.381 0 0 0 5.376-5.387" fill="#eee"></path>
																	<path d="M34.048 54a5.381 5.381 0 0 0 5.376-5.387 5.381 5.381 0 0 0-5.376-5.386h-5.376v5.386A5.381 5.381 0 0 0 34.048 54m0-14.365h14.336a5.381 5.381 0 0 0 5.376-5.386 5.381 5.381 0 0 0-5.376-5.387H34.048a5.381 5.381 0 0 0-5.376 5.387 5.381 5.381 0 0 0 5.376 5.386" fill="#eee"></path>
																	<path d="M0 34.249a5.381 5.381 0 0 0 5.376 5.386 5.381 5.381 0 0 0 5.376-5.386v-5.387H5.376A5.381 5.381 0 0 0 0 34.25m14.336-.001v14.364A5.381 5.381 0 0 0 19.712 54a5.381 5.381 0 0 0 5.376-5.387V34.25a5.381 5.381 0 0 0-5.376-5.387 5.381 5.381 0 0 0-5.376 5.387" fill="#eee"></path>
																</g>
															</svg>
															<p class="ml-2.5 text-sm font-medium">choose one</p>
														</div>
														<button class="relative inline-flex items-center bg-blue-700 p-2 rounded-l-none rounded-r-md text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:z-10 focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-blue-300" id="headlessui-listbox-button-5" type="button" aria-haspopup="true" aria-expanded="false" aria-labelledby="headlessui-listbox-label-4 headlessui-listbox-button-5">
															<span class="sr-only">Change default channel</span>
															<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" class="svg-inline--fa fa-chevron-down h-5 w-5 text-white" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
																<path fill="currentColor" d="M224 416c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L224 338.8l169.4-169.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-192 192C240.4 412.9 232.2 416 224 416z"></path>
															</svg>
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="bg-white">
								<div class="px-4 py-5 sm:p-6">
									<div class="flex">
										<div class="grow">
											<h3 class="text-lg leading-6 font-medium text-gray-900">Channels visibility</h3>
											<div class="mt-2 sm:flex sm:items-start sm:justify-between">
												<div class="max-w-xl text-sm text-gray-500">
													<p>Pick which channels to display or hide.</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="bg-white">
								<div class="px-4 py-5 sm:p-6">
									<div class="flex">
										<div class="grow">
											<h3 class="text-lg leading-6 font-medium text-gray-900">Home URL</h3>
											<div class="mt-2 sm:flex sm:items-start sm:justify-between">
												<div class="max-w-xl text-sm text-gray-500">
													<p>Link to your home page.</p>
												</div>
											</div>
										</div>
									</div>
									<div class="mt-3 relative rounded-md shadow-sm">
										<input type="text"
											   name="home-url"
											   id="home-url"
											   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
											   placeholder="https://yourwebsite.com">
									</div>
								</div>
							</div>
							<div class="bg-white">
								<div class="px-4 py-5 sm:p-6">
									<div class="flex">
										<div class="grow">
											<h3 class="text-lg leading-6 font-medium text-gray-900">Docs URL</h3>
											<div class="mt-2 sm:flex sm:items-start sm:justify-between">
												<div class="max-w-xl text-sm text-gray-500">
													<p>Link to your documentation.</p>
												</div>
											</div>
										</div>
									</div>
									<div class="mt-3 relative rounded-md shadow-sm">
										<input type="text"
											   name="docs-url"
											   id="docs-url"
											   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
											   placeholder="https://docs.yourwebsite.com">
									</div>
								</div>
							</div>
							<div class="bg-white">
								<div class="px-4 py-5 sm:p-6">
									<div class="flex">
										<div class="grow">
											<h3 class="text-lg leading-6 font-medium text-gray-900">Community Invitation URL</h3>
											<div class="mt-2 sm:flex sm:items-start sm:justify-between">
												<div class="max-w-xl text-sm text-gray-500">
													<p>Link to your community invite.</p>
												</div>
											</div>
										</div>
									</div>
									<div class="mt-3 relative rounded-md shadow-sm">
										<input type="text"
											   name="invitation-url"
											   id="invitation-url"
											   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
											   placeholder="https://yourwebsite.com/community-invite">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
