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
										<textarea name="brand_custom_code" x-model="formData.brand_custom_code" rows="3" class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md"></textarea>
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
                                        <option value="">Select</option>
                                        <option value="comments">Comments</option>
                                        <option value="reactions">Reactions</option>
                                        <option value="replies">Replies</option>
                                    </select>
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
        function brandingForm() {
            return {
                formData: {
                    'brand_custom_domain' : '{{$account->brand_custom_domain}}',
                    'brand_embed_url' : '{{$account->brand_embed_url}}',
                    'brand_custom_code' : '{{$account->brand_custom_code}}',
                    'brand_primary_color' : '{{$account->brand_primary_color}}',
                    'brand_secondary_color' : '{{$account->brand_secondary_color}}',
                    'brand_popular_by' : '{{$account->brand_popular_by}}',
                },
                formMessage: "",
                submitForm() {
                    let finalData = this.formData;
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

    </script>
</x-app-layout>
