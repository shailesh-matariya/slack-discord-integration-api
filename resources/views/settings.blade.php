<x-app-layout>
	<div class="max-w-6xl xl:w-full mx-auto flex flex-col md:px-8 xl:px-0 bg-slate-50">
		<div class="py-10">
			<div class="max-w-6xl mx-auto px-4">
				<h1 class="text-3xl font-extrabold text-gray-900">Settings</h1>
				<div class="ph-6">
					<div class="grid grid-cols-1 gap-4">
						<div class="grid grid-cols-1 divide-y divide-gray-200 divide-solid">
							<div>
								@if ($account)
								<div class="mt-3 px-4 py-5 sm:p-6 bg-indigo-100 text-indigo-900 text-lg font-medium">
									<a href="{{$account->brand_custom_domain && $account->brand_custom_domain != '' ? $account->brand_custom_domain : config('app.frontend_url').'/t/'.$account->team_id}}" target="_blank">
										{{$account->brand_custom_domain && $account->brand_custom_domain != '' ? $account->brand_custom_domain : parse_url(config('app.frontend_url'),	PHP_URL_HOST)
										.'/t/'.$account->team_id}}
									</a>
								</div>
								@endif
								<div class="px-4 py-5 sm:p-6">
									<div class="flex">
                                        @if ($account?->platform === 'slack')
                                            <div class="grow">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                    Slack integration
                                                    <span class="text-gray-300"> | </span>
                                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check h-5 w-5 mr-1 inline"
                                                         role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" color="green">
                                                        <path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>
                                                    </svg>
                                                    Done
                                                </h3>
                                                <div class="mt-2 sm:flex sm:items-start sm:justify-between">
                                                    <div class="max-w-xl text-sm text-gray-500">
                                                        <p>Connect to Slack to fetch conversation.</p>
                                                    </div>
                                                </div>
                                            </div>
										@elseif($account?->platform === 'discord')
											<div class="grow">
												<h3 class="text-lg leading-6 font-medium text-gray-900">
													Discord integration
													<span class="text-gray-300"> | </span>
													<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle-check" class="svg-inline--fa fa-circle-check h-5 w-5 mr-1 inline"
														 role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" color="green">
														<path fill="currentColor" d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"></path>
													</svg>
													Done
												</h3>
												<div class="mt-2 sm:flex sm:items-start sm:justify-between">
													<div class="max-w-xl text-sm text-gray-500">
														<p>Connect to Discord to fetch conversation.</p>
													</div>
												</div>
											</div>
                                        @else
                                            <div class="grow">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                                    Slack/Discord integration
                                                </h3>
                                                <div class="mt-2 sm:flex sm:items-start sm:justify-between">
                                                    <div class="max-w-xl text-sm text-gray-500">
                                                        <p>Connect to Slack/Discord to fetch conversations.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif


										<div class="flex flex-col items-center gap-2">
											<div class="grid grid-cols-1 gap-4">
												@if (! $account || $account?->platform === 'slack')
													<a href="{{ $slackUrl }}" class="flex rounded-md border p-2 justify-around border-gray-300 text-base w-52">
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
																<p class="whitespace-nowrap">Connect to <b>Slack</b></p>
															@else
																<p class="whitespace-nowrap">Reconnect to <b>Slack</b></p>
															@endif
														</div>
													</a>
												@endif

												@if (! $account || $account?->platform === 'discord')
													<a href="{{ $discordUrl }}" class="flex rounded-md border p-2 justify-around border-gray-300 text-base w-52">
														<div class="flex gap-2 items-center">
															<svg width="20" height="20" viewBox="0 0 71 55" fill="none" xmlns="http://www.w3.org/2000/svg">
																<g clip-path="url(#clip0)">
																	<path d="M60.1045 4.8978C55.5792 2.8214 50.7265 1.2916 45.6527 0.41542C45.5603 0.39851 45.468 0.440769 45.4204 0.525289C44.7963 1.6353 44.105 3.0834 43.6209 4.2216C38.1637 3.4046 32.7345 3.4046 27.3892 4.2216C26.905 3.0581 26.1886 1.6353 25.5617 0.525289C25.5141 0.443589 25.4218 0.40133
															25.3294 0.41542C20.2584 1.2888 15.4057 2.8186 10.8776 4.8978C10.8384 4.9147 10.8048 4.9429 10.7825 4.9795C1.57795 18.7309 -0.943561 32.1443 0.293408 45.3914C0.299005 45.4562 0.335386 45.5182 0.385761 45.5576C6.45866 50.0174 12.3413 52.7249 18.1147 54.5195C18.2071 54.5477 18.305 54.5139
															18.3638 54.4378C19.7295 52.5728 20.9469 50.6063 21.9907 48.5383C22.0523 48.4172 21.9935 48.2735 21.8676 48.2256C19.9366 47.4931 18.0979 46.6 16.3292 45.5858C16.1893 45.5041 16.1781 45.304 16.3068 45.2082C16.679 44.9293 17.0513 44.6391 17.4067 44.3461C17.471 44.2926 17.5606 44.2813 17.6362
															44.3151C29.2558 49.6202 41.8354 49.6202 53.3179 44.3151C53.3935 44.2785 53.4831 44.2898 53.5502 44.3433C53.9057 44.6363 54.2779 44.9293 54.6529 45.2082C54.7816 45.304 54.7732 45.5041 54.6333 45.5858C52.8646 46.6197 51.0259 47.4931 49.0921 48.2228C48.9662 48.2707 48.9102 48.4172 48.9718
															48.5383C50.038 50.6034 51.2554 52.5699 52.5959 54.435C52.6519 54.5139 52.7526 54.5477 52.845 54.5195C58.6464 52.7249 64.529 50.0174 70.6019 45.5576C70.6551 45.5182 70.6887 45.459 70.6943 45.3942C72.1747 30.0791 68.2147 16.7757 60.1968 4.9823C60.1772 4.9429 60.1437 4.9147 60.1045 4.8978ZM23.7259
															37.3253C20.2276 37.3253 17.3451 34.1136 17.3451 30.1693C17.3451 26.225 20.1717 23.0133 23.7259 23.0133C27.308 23.0133 30.1626 26.2532 30.1066 30.1693C30.1066 34.1136 27.28 37.3253 23.7259 37.3253ZM47.3178 37.3253C43.8196 37.3253 40.9371 34.1136 40.9371 30.1693C40.9371 26.225 43.7636 23.0133
															47.3178 23.0133C50.9 23.0133 53.7545 26.2532 53.6986 30.1693C53.6986 34.1136 50.9 37.3253 47.3178 37.3253Z" fill="#5865F2"></path>
																</g>
																<defs>
																	<clipPath id="clip0">
																		<rect width="71" height="55" fill="white"></rect>
																	</clipPath>
																</defs>
															</svg>
															@if (! $account)
																<p class="whitespace-nowrap">Connect to <b>Discord</b></p>
															@else
																<p class="whitespace-nowrap">Reconnect to <b>Discord</b></p>
															@endif
														</div>
													</a>
												@endif
													@if($account)
														<a href="javascript:void(0)" x-data="" class="flex rounded-md border p-2 justify-around border-gray-300 text-base w-52
														text-white bg-red-600" @click="removeAccount()">
															<div class="flex gap-2 items-center">
																<svg version="1.1" width="20" height="20" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
																	 x="0px" fill="#ffffff"
																	 y="0px"
																	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M60.236,210.824L90.354,512h331.294l30.118-301.176H60.236z M188.236,459.294H143.06V263.529h45.176V459.294z M278.589,459.294h-45.177V263.529h45.177V459.294z M368.942,459.294h-45.176V263.529h45.176V459.294z"/></g></g><g><g><path d="M391.53,90.353h-52.706v-7.529C338.824,37.155,301.67,0,256.001,0s-82.824,37.155-82.824,82.824v7.529h-52.706c-44.767,0-81.908,32.565-89.08,75.294h449.218C473.438,122.918,436.297,90.353,391.53,90.353z M293.648,90.353h-75.294v-7.529c0-20.759,16.888-37.647,37.647-37.647s37.647,16.888,37.647,37.647V90.353z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
																<p class="whitespace-nowrap">Remove account</p>
															</div>
														</a>
													@endif
											</div>
										</div>
									</div>
								</div>
							</div>
							<div>
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

                                        @if($account)
                                            <div class="self-center">
                                                <div
													class="{{ !$subscribed ? 'pointer-events-none' : ''}} mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center"
													x-data="{ isChecked:{{$account?->is_anonymize ? 'true' : 'false' }} }"
													x-init="$watch('isChecked', (value, oldValue) => setUserAnonymize(value))">
													<input
														id="candidates"
														aria-describedby="candidates-description"
														name="candidates"
														type="checkbox"
														class="h-5 w-5 rounded border-gray-300 text-gray-600 focus:ring-gray-500 disabled:opacity-50"
														x-bind:value="isChecked"
														@click="isChecked = !isChecked"
														@if	(!$subscribed) disabled @endif>
                                                </div>
                                            </div>
                                        @else
                                            <div class="self-center">
                                                <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                                                    <p class="text-sm text-gray-400">Waiting for integration</p>
                                                </div>
                                            </div>
                                        @endif


									</div>
								</div>
							</div>
							<div>
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
                                        @if($account)
										    <div class="self-center">
                                                <label class="sr-only">Change published status</label>
                                                <div class="relative" x-data="{dropdownMenu: false, buttonLabel: '{{$defaultChannel ? $defaultChannel?->name : 'choose one' }}'}">
                                                    <div class="inline-flex shadow-sm rounded-md divide-x divide-gray-700">
                                                        <div class="relative z-0 inline-flex shadow-sm rounded-md divide-x divide-gray-700">
                                                            <div class="relative inline-flex items-center bg-gray-700 py-2 pl-3 pr-4 border border-transparent rounded-l-md shadow-sm text-white">
																@if($account?->platform === 'slack')
                                                                <svg width="14px" height="14px" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg">
                                                                    <g fill="none" fill-rule="evenodd">
                                                                        <path d="M19.712.133a5.381 5.381 0 0 0-5.376 5.387 5.381 5.381 0 0 0 5.376 5.386h5.376V5.52A5.381 5.381 0 0 0 19.712.133m0 14.365H5.376A5.381 5.381 0 0 0 0 19.884a5.381 5.381 0 0 0 5.376 5.387h14.336a5.381 5.381 0 0 0 5.376-5.387 5.381 5.381 0 0 0-5.376-5.386" fill="#eee"></path>
                                                                        <path d="M53.76 19.884a5.381 5.381 0 0 0-5.376-5.386 5.381 5.381 0 0 0-5.376 5.386v5.387h5.376a5.381 5.381 0 0 0 5.376-5.387m-14.336 0V5.52A5.381 5.381 0 0 0 34.048.133a5.381 5.381 0 0 0-5.376 5.387v14.364a5.381 5.381 0 0 0 5.376 5.387 5.381 5.381 0 0 0 5.376-5.387" fill="#eee"></path>
                                                                        <path d="M34.048 54a5.381 5.381 0 0 0 5.376-5.387 5.381 5.381 0 0 0-5.376-5.386h-5.376v5.386A5.381 5.381 0 0 0 34.048 54m0-14.365h14.336a5.381 5.381 0 0 0 5.376-5.386 5.381 5.381 0 0 0-5.376-5.387H34.048a5.381 5.381 0 0 0-5.376 5.387 5.381 5.381 0 0 0 5.376 5.386" fill="#eee"></path>
                                                                        <path d="M0 34.249a5.381 5.381 0 0 0 5.376 5.386 5.381 5.381 0 0 0 5.376-5.386v-5.387H5.376A5.381 5.381 0 0 0 0 34.25m14.336-.001v14.364A5.381 5.381 0 0 0 19.712 54a5.381 5.381 0 0 0 5.376-5.387V34.25a5.381 5.381 0 0 0-5.376-5.387 5.381 5.381 0 0 0-5.376 5.387" fill="#eee"></path>
                                                                    </g>
                                                                </svg>
																@endif
																@if($account?->platform === 'discord')
																		<svg width="20" height="20" viewBox="0 0 71 55" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<g clip-path="url(#clip0)">
																			<path d="M60.1045 4.8978C55.5792 2.8214 50.7265 1.2916 45.6527 0.41542C45.5603 0.39851 45.468 0.440769 45.4204 0.525289C44.7963 1.6353 44.105 3.0834 43.6209 4.2216C38.1637 3.4046 32.7345 3.4046 27.3892 4.2216C26.905 3.0581 26.1886 1.6353 25.5617 0.525289C25.5141 0.443589 25.4218 0.40133
															25.3294 0.41542C20.2584 1.2888 15.4057 2.8186 10.8776 4.8978C10.8384 4.9147 10.8048 4.9429 10.7825 4.9795C1.57795 18.7309 -0.943561 32.1443 0.293408 45.3914C0.299005 45.4562 0.335386 45.5182 0.385761 45.5576C6.45866 50.0174 12.3413 52.7249 18.1147 54.5195C18.2071 54.5477 18.305 54.5139
															18.3638 54.4378C19.7295 52.5728 20.9469 50.6063 21.9907 48.5383C22.0523 48.4172 21.9935 48.2735 21.8676 48.2256C19.9366 47.4931 18.0979 46.6 16.3292 45.5858C16.1893 45.5041 16.1781 45.304 16.3068 45.2082C16.679 44.9293 17.0513 44.6391 17.4067 44.3461C17.471 44.2926 17.5606 44.2813 17.6362
															44.3151C29.2558 49.6202 41.8354 49.6202 53.3179 44.3151C53.3935 44.2785 53.4831 44.2898 53.5502 44.3433C53.9057 44.6363 54.2779 44.9293 54.6529 45.2082C54.7816 45.304 54.7732 45.5041 54.6333 45.5858C52.8646 46.6197 51.0259 47.4931 49.0921 48.2228C48.9662 48.2707 48.9102 48.4172 48.9718
															48.5383C50.038 50.6034 51.2554 52.5699 52.5959 54.435C52.6519 54.5139 52.7526 54.5477 52.845 54.5195C58.6464 52.7249 64.529 50.0174 70.6019 45.5576C70.6551 45.5182 70.6887 45.459 70.6943 45.3942C72.1747 30.0791 68.2147 16.7757 60.1968 4.9823C60.1772 4.9429 60.1437 4.9147 60.1045 4.8978ZM23.7259
															37.3253C20.2276 37.3253 17.3451 34.1136 17.3451 30.1693C17.3451 26.225 20.1717 23.0133 23.7259 23.0133C27.308 23.0133 30.1626 26.2532 30.1066 30.1693C30.1066 34.1136 27.28 37.3253 23.7259 37.3253ZM47.3178 37.3253C43.8196 37.3253 40.9371 34.1136 40.9371 30.1693C40.9371 26.225 43.7636 23.0133
															47.3178 23.0133C50.9 23.0133 53.7545 26.2532 53.6986 30.1693C53.6986 34.1136 50.9 37.3253 47.3178 37.3253Z" fill="#FFF"></path>
																		</g>
																		<defs>
																			<clipPath id="clip0">
																				<rect width="71" height="55" fill="white"></rect>
																			</clipPath>
																		</defs>
																	</svg>
                                                                <p class="ml-2.5 text-sm font-medium" x-text="buttonLabel"></p>
                                                            </div>

														@endif

                                                            <!-- Dropdown toggle button -->
                                                            <button class="relative inline-flex items-center bg-gray-700 p-2 rounded-l-none rounded-r-md text-sm font-medium text-white hover:bg-gray-800
                                                            focus:outline-none focus:z-10" type="button" @click="dropdownMenu = ! dropdownMenu">
                                                                <span class="sr-only">Change default channel</span>
                                                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" class="svg-inline--fa fa-chevron-down h-4 w-5
                                                                text-white" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                                    <path fill="currentColor" d="M224 416c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L224 338.8l169.4-169.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-192 192C240.4 412.9 232.2 416 224 416z"></path>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <ul x-show="dropdownMenu" class="origin-top-right absolute z-10 right-0 mt-2 w-72 rounded-md shadow-lg overflow-hidden bg-white ring-1 ring-black
                                                    ring-opacity-5 focus:outline-none" x-data="{channels: {{$channels}}, defaultChannelId: '{{$defaultChannel?->id}}' }" @click.outside="dropdownMenu=!dropdownMenu">
                                                        <template x-for="channel in channels">
                                                            <li class="text-gray-900 cursor-default hover:bg-gray-100 relative p-2 text-sm" role="option" tabindex="-1" @click="setDefaultChannel(channel);
                                                             buttonLabel=channel.name;defaultChannelId=channel.id; dropdownMenu=!dropdownMenu">
                                                                <div class="flex flex-col">
                                                                    <div class="flex justify-between">
                                                                        <p :class="{'font-semibold': defaultChannelId === channel.id, 'font-normal': defaultChannelId !== channel.id}"
                                                                           x-text="channel.name"></p>
                                                                        <span class="text-green-600" x-show="defaultChannelId === channel.id">
                                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" class="svg-inline--fa fa-check h-5 w-5"
                                                                             role="img"
                                                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                                                <path fill="currentColor" d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path>
                                                                            </svg>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </template>
                                                    </ul>
                                                </div>
                                            </div>
                                        @else
                                            <div class="self-center">
                                                <div class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                                                    <p class="text-sm text-gray-400">Waiting for integration</p>
                                                </div>
                                            </div>
                                        @endif
									</div>
								</div>
							</div>
							<div>
								<div class="px-4 py-5 sm:p-6">
									<div class="flex">
										<div class="grow">
											<h3 class="text-lg leading-6 font-medium text-gray-700">Channels visibility</h3>
											<div class="mt-2 sm:flex sm:items-start sm:justify-between">
												<div class="max-w-xl text-sm text-gray-500">
													<p>Pick which channels to display or hide.</p>
												</div>
											</div>
											<div class="{{ !$subscribed ? 'pointer-events-none' : ''}} mt-2 sm:flex sm:items-end sm:justify-between">
												<div class="flex-grow" x-data="{channels: {{$channels}}}">
													<template x-for="channel in channels">
														<div class="flex items-center m-1">
															<input
																id="candidates"
																aria-describedby="candidates-description"
																name="candidates"
																type="checkbox"
																class="h-5 w-5 rounded border-gray-300 text-gray-600 focus:ring-gray-500 mr-3 disabled:opacity-50"
																x-bind:value="!!channel.is_visible"
																@click="setChannelVisibility(channel);channel.is_visible = !channel.is_visible"
																@if	(!$subscribed) disabled @endif
															>
															<span x-bind:class="channel.is_visible ? 'text-gray-900' : 'text-gray-400 line-through'" class="text-sm font-medium"
																  id="headlessui-label-7" x-text="channel.name"></span>
															<input type="hidden" x-bind:name="channel.name" value="false">
														</div>
													</template>
												</div>
											</div>
										</div>
                                        @if(!$account)
                                            <p class="text-sm text-gray-400">Waiting for integration</p>
                                        @endif
									</div>
								</div>
							</div>
{{--							<div>--}}
{{--								<div class="px-4 py-5 sm:p-6">--}}
{{--									<div class="flex">--}}
{{--										<div class="grow">--}}
{{--											<h3 class="text-lg leading-6 font-medium text-gray-900">Home URL</h3>--}}
{{--											<div class="mt-2 sm:flex sm:items-start sm:justify-between">--}}
{{--												<div class="max-w-xl text-sm text-gray-500">--}}
{{--													<p>Link to your home page.</p>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--										</div>--}}
{{--									</div>--}}
{{--									<div class="mt-3 relative rounded-md shadow-sm">--}}
{{--										<input type="text"--}}
{{--											   name="home-url"--}}
{{--											   id="home-url"--}}
{{--											   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"--}}
{{--											   placeholder="https://yourwebsite.com">--}}
{{--									</div>--}}
{{--								</div>--}}
{{--							</div>--}}
{{--							<div>--}}
{{--								<div class="px-4 py-5 sm:p-6">--}}
{{--									<div class="flex">--}}
{{--										<div class="grow">--}}
{{--											<h3 class="text-lg leading-6 font-medium text-gray-900">Docs URL</h3>--}}
{{--											<div class="mt-2 sm:flex sm:items-start sm:justify-between">--}}
{{--												<div class="max-w-xl text-sm text-gray-500">--}}
{{--													<p>Link to your documentation.</p>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--										</div>--}}
{{--									</div>--}}
{{--									<div class="mt-3 relative rounded-md shadow-sm">--}}
{{--										<input type="text"--}}
{{--											   name="docs-url"--}}
{{--											   id="docs-url"--}}
{{--											   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"--}}
{{--											   placeholder="https://docs.yourwebsite.com">--}}
{{--									</div>--}}
{{--								</div>--}}
{{--							</div>--}}
{{--							<div>--}}
{{--								<div class="px-4 py-5 sm:p-6">--}}
{{--									<div class="flex">--}}
{{--										<div class="grow">--}}
{{--											<h3 class="text-lg leading-6 font-medium text-gray-900">Community Invitation URL</h3>--}}
{{--											<div class="mt-2 sm:flex sm:items-start sm:justify-between">--}}
{{--												<div class="max-w-xl text-sm text-gray-500">--}}
{{--													<p>Link to your community invite.</p>--}}
{{--												</div>--}}
{{--											</div>--}}
{{--										</div>--}}
{{--									</div>--}}
{{--									<div class="mt-3 relative rounded-md shadow-sm">--}}
{{--										<input type="text"--}}
{{--											   name="invitation-url"--}}
{{--											   id="invitation-url"--}}
{{--											   class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"--}}
{{--											   placeholder="https://yourwebsite.com/community-invite">--}}
{{--									</div>--}}
{{--								</div>--}}
{{--							</div>--}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		function setChannelVisibility(channel){
      		fetch('{{route('setChannelVisibility')}}', {
              method: 'POST',
              body: JSON.stringify({
                account_id: channel.account_id,
                channel_id: channel.channelId,
				is_visible: !channel.is_visible
              }),
              headers: {
                'Content-type': 'application/json; charset=UTF-8',
              },
            }).then((response) => response.json()) //2
              .then((data) => {
                toastr.success(data.message);
              })
              .catch(() => {
                toastr.error('Something went wrong.');
              });
		}

		function setUserAnonymize(value) {
          fetch('{{route('setUserAnonymize')}}', {
            method: 'POST',
            body: JSON.stringify({
              account_id: '{{$account?->id}}',
              is_anonymize: value
            }),
            headers: {
              'Content-type': 'application/json; charset=UTF-8',
            },
          }).then((response) => response.json()) //2
            .then((data) => {
              toastr.success(data.message);
            })
            .catch(() => {
              toastr.error('Something went wrong.');
            });
		}

		function setDefaultChannel(channel) {
          fetch('{{route('setDefaultChannel')}}', {
            method: 'POST',
            body: JSON.stringify({
              channel: channel,
              is_default: true
            }),
            headers: {
              'Content-type': 'application/json; charset=UTF-8',
            },
          }).then((response) => response.json()) //2
            .then((data) => {
              toastr.success(data.message);
            })
            .catch(() => {
              toastr.error('Something went wrong.');
            });
		}

		function removeAccount() {
          console.log('RemoveAccount');
          fetch('{{route('removeAccount')}}', {
            method: 'POST',
            body: JSON.stringify({}),
            headers: {
              'Content-type': 'application/json; charset=UTF-8',
            },
          }).then((response) => response.json()) //2
            .then((data) => {
              setTimeout(() => location.reload(), 1500)
              toastr.success('Account removed successfully!');
            })
            .catch(() => {
              toastr.error('Something went wrong.');
            });
		}
	</script>
</x-app-layout>
