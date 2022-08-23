<x-app-layout>
	<div x-data class="max-w-4xl mx-auto flex flex-col md:px-8 xl:px-0">
		<div class="py-10">
			<div class="max-w-4xl mx-auto px-4">
				<h1 class="text-3xl font-extrabold text-gray-900">Branding</h1>
				<div class="py-6">
					<form action="#"  x-data="brandingForm()" @submit.prevent="submitForm">
						<div class="grid grid-cols-1">
							<div class="flex flex-col">
								<div class="p-3 mb-3 rounded border-gray-200 border-solid border bg-slate-50">
									<label class="block text-sm font-bold leading-5 mb-1">Custom Domain</label>
{{--									<div class="text-sm mb-2 text-gray-600">Unique domain to redirect to.</div>--}}
									<div class="mt-1 relative rounded-md shadow-sm">
										<input type="text" name="brand_custom_domain" x-model="formData.brand_custom_domain"  class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300
										rounded-md" placeholder="example.com">
									</div>
								</div>
                                <div class="p-3 mb-3 rounded border-gray-200 border-solid border bg-slate-50">
                                    <label class="block text-sm font-bold leading-5 mb-1">Embed URL</label>
{{--                                    <div class="text-sm mb-2 text-gray-600">Unique domain to redirect to.</div>--}}
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <input type="text" name="brand_embed_url" x-model="formData.brand_embed_url" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300
										rounded-md" placeholder="http://example.com">
                                    </div>
                                </div>
								<div class="p-3 mb-3 rounded border-gray-200 border-solid border bg-slate-50">
									<label class="block text-sm font-bold leading-5 mb-1">Custom Code</label>
									<div class="text-sm mb-2 text-gray-600">Add custom code to be inserted before HEAD tag on your own generated site.</div>
									<div class="mt-1 relative rounded-md shadow-sm">
										<textarea name="brand_custom_code" x-model="formData.brand_custom_code" rows="3" class="shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"></textarea>
									</div>
								</div>
								<div class="p-3 mb-3 rounded border-gray-200 border-solid border bg-slate-50">
									<label class="block text-sm font-bold leading-5 mb-1">Brand Color</label>
									<div class="text-sm mb-2 text-gray-600">Color that matches your brand. We'll use it for the header background.</div>
									<div class="flex space-x-4">
										<div class="shrink w-36">
											<label class="block text-sm font-normal leading-5 mb-1">Primary Color</label>
											<div class="mt-1 relative rounded-md shadow-sm">
												<input type="color" name="brand_primary_color" x-model="formData.brand_primary_color" class="h-9 py-0 px-0.5 bg-white focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm
										border-gray-300 rounded-md" value="#E2E2E2">
											</div>
										</div>

										<div class="shrink w-36">
											<label for="brandColor" class="block text-sm font-normal leading-5 mb-1">Secondary Color</label>
											<div class="mt-1 relative rounded-md shadow-sm">
												<input type="color" name="brand_secondary_color" x-model="formData.brand_secondary_color" class="h-9 py-0 px-0.5 bg-white focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm
										border-gray-300 rounded-md" value="#E2E2E2">
											</div>
										</div>
									</div>
								</div>
								<div class="p-3 mb-3 rounded border-gray-200 border-solid border bg-slate-50">
									<label for="logo" class="block text-sm font-bold leading-5 mb-1">Logo</label>
									<div class="text-sm mb-2 text-gray-600">Logo of your brand.</div>
									<input x-ref="brand_logo"  type="file" name="brand_logo"  style="display:none">
									<button
                                        @click="$refs.brand_logo.click()"
                                        type="button"
                                        class="font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:ring-4 focus:outline-none text-black bg-gray-200"
                                    >Upload file</button>
								</div>
                                <div class="p-3 mb-3 rounded border-gray-200 border-solid border bg-slate-50">
                                    <label for="logo" class="block text-sm font-bold leading-5 mb-1">Most popular by</label>
                                    <select id="brand_popular_by" name="brand_popular_by" x-model="formData.brand_popular_by" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="comments">Comments</option>
                                        <option value="reactions">Reactions</option>
                                        <option value="replies">Replies</option>
                                    </select>

									<div x-data="dropdown()" x-init="loadOptions()" class="w-full md:w-1/2 flex flex-col items-center">
										<input name="values" type="hidden" x-bind:value="selectedValues()">
										<div class="inline-block relative w-80">
											<div class="flex flex-col items-center relative">
												<div x-on:click="open" class="w-full">
													<div class="my-2 p-1 flex border border-gray-200 bg-white rounded">
														<div class="flex flex-auto flex-wrap">
															<template x-for="(option,index) in selected" :key="options[option].value">
																<div class="flex justify-center items-center m-1 font-medium py-1 px-1 bg-white rounded bg-gray-100 border">
																	<div class="text-xs font-normal leading-none max-w-full flex-initial x-model=" options[option] x-text="options[option].text"></div>
																	<div class="flex flex-auto flex-row-reverse">
																		<div x-on:click.stop="remove(index,option)">
																			<svg class="fill-current h-4 w-4 " role="button" viewBox="0 0 20 20">
																				<path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                           c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                           l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                           C14.817,13.62,14.817,14.38,14.348,14.849z" />
																			</svg>
																		</div>
																	</div>
																</div>
															</template>
															<div x-show="selected.length == 0" class="flex-1">
																<input placeholder="Select a option" class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800" x-bind:value="selectedValues()">
															</div>
														</div>
														<div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">

															<button type="button" x-show="isOpen() === true" x-on:click="open" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
																<svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
																	<path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
	c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
	L17.418,6.109z" />
																</svg>
															</button>
															<button type="button" x-show="isOpen() === false" @click="close" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
																<svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
																	<path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
	c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
	" />
																</svg>
															</button>
														</div>
													</div>
												</div>
												<div class="w-full px-4">
													<div x-show.transition.origin.top="isOpen()" class="absolute shadow top-100 bg-white z-40 w-full left-0 rounded max-h-select" x-on:click.away="close">
														<div class="flex flex-col w-full">
															<template x-for="(option,index) in options" :key="option" class="overflow-auto">
																<div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-gray-100" @click="select(index,$event)">
																	<div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
																		<div class="w-full items-center flex justify-between">
																			<div class="mx-2 leading-6" x-model="option" x-text="option.text"></div>
																			<div x-show="option.selected">
																				<svg class="svg-icon" viewBox="0 0 20 20">
																					<path fill="none" d="M7.197,16.963H7.195c-0.204,0-0.399-0.083-0.544-0.227l-6.039-6.082c-0.3-0.302-0.297-0.788,0.003-1.087
							C0.919,9.266,1.404,9.269,1.702,9.57l5.495,5.536L18.221,4.083c0.301-0.301,0.787-0.301,1.087,0c0.301,0.3,0.301,0.787,0,1.087
							L7.741,16.738C7.596,16.882,7.401,16.963,7.197,16.963z"></path>
																				</svg>
																			</div>
																		</div>
																	</div>
																</div>
															</template>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
                                </div>
								<div class="flex justify-end">
									<button type="submit" class="font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:ring-4 focus:outline-none text-white bg-yellow-600 hover:bg-yellow-500 focus:ring-yellow-600">Upgrade your account</button>
								</div>
							</div>
						</div>
                        <div x-text="formMessage"></div>
                    </form>
				</div>
			</div>
		</div>
	</div>
    <script>
	  let selectedOptions = [];
        function brandingForm() {
            return {
                formData: {
                  	'account_id' : {{$account->id}},
                    'brand_custom_domain' : '{{$account->brand_custom_domain}}',
                    'brand_embed_url' : '{{$account->brand_embed_url}}',
                    'brand_custom_code' : '{{$account->brand_custom_code}}',
                    'brand_primary_color' : '{{$account->brand_primary_color}}',
                    'brand_secondary_color' : '{{$account->brand_secondary_color}}',
                    'brand_popular_by' : @json($account->brand_popular_by),
                },
                formMessage: "",
                submitForm() {
                    let finalData = this.formData;
                    this.formData.brand_popular_by = [...new Set(selectedOptions)];
                    var formData = new FormData();
                    for (let x in finalData) {
                        formData.append(x, finalData[x]);
                    }
                    formData.append('account_id', '{{$account->id}}');
                    if(this.$refs.brand_logo.files.length>0){
                        formData.append('brand_logo', this.$refs.brand_logo.files[0]);
                    }

                    fetch('{{route('setBrandingData')}}', {
                        method: 'POST',
                        body: formData,
                        processData: false,
                        headers: {
                            'X-CSRF-TOKEN' : '{{csrf_token()}}',
                            contentType: false,
                        },
                    }).then((response) => response.json()) //2
                    .then((data) => {
                        this.formMessage = data.msg;
                        console.log(data); //3
                    })
                    .catch(() => {
                        this.formMessage = "Something went wrong.";
                    });
                },
            };
        }

        function dropdown() {
          return {
            options: [],
            selected: [],
            show: false,
            open() { this.show = true },
            close() { this.show = false },
            isOpen() { return this.show === true },
            select(index, event) {

              if (!this.options[index].selected) {

                this.options[index].selected = true;
                this.options[index].element = event.target;
                this.selected.push(index);

              } else {
                this.selected.splice(this.selected.lastIndexOf(index), 1);
                this.options[index].selected = false
              }
            },
            remove(index, option) {
              this.options[option].selected = false;
              this.selected.splice(index, 1);
              selectedOptions.splice(index, 1);
            },
            loadOptions() {
              const options = document.getElementById('brand_popular_by').options;
              for (let i = 0; i < options.length; i++) {
                this.options.push({
                  value: options[i].value,
                  text: options[i].innerText,
                  selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                });
              }
            },
            selectedValues(){
              return this.selected.map((option)=>{
                selectedOptions.push(this.options[option].value);
                selectedOptions = [...new Set(selectedOptions)];
                return this.options[option].value;
              })
            }
          }
        }

    </script>

	@push('css')
		<style>
			#brand_popular_by {
				display: none;
			}
            .svg-icon {
                width: 1em;
                height: 1em;
            }

            .svg-icon path,
            .svg-icon polygon,
            .svg-icon rect {
                fill: #333;
            }

            .svg-icon circle {
                stroke: #4691f6;
                stroke-width: 1;
            }
		</style>
	@endpush
</x-app-layout>
