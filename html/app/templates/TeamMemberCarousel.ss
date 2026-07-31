<section class="bg-[#f3f4f5] py-32">
	<div class="container">
		<div class="rte mx-auto mb-14 max-w-[46.75rem] text-center">
			$HeadingContent
		</div>
		<div class="team-carousel swiper inner-container">
            <div class="swiper-wrapper">
                <% loop $TeamMembers %>
                    <div class="swiper-slide mr-10 w-auto">
                        <div class="teamcard group">
                            <div class="card">
                                <a href="/about-us/our-team#$URI" class="toggle" title="$Name">
                                    <img
                                        class="mb-5 h-[25rem] w-[23.125rem] object-cover grayscale-0 group-hover:grayscale"
                                        src="$Photo.Fit(1100, 750).URL"
                                        alt="$Name"
                                    />
                                </a>
                                <div class="max-w-[23.125rem] px-[1.25rem] text-center">
                                    <h2 class="mb-1 font-playfair text-2xl font-bold">$Name</h2>
                                    <h3 class="mb-3 text-sd uppercase tracking-[0.0875rem]">$Role</h3>
                                    <p class="text-body line-clamp-3">
                                        $Bio.Summary
                                    </p>
                                    <div class="mt-5 flex flex-col gap-3 border-t border-gray-border pt-5">
                                        <% if $Email %>
                                            <a
                                                class="flex items-center justify-center gap-4 text-md text-heading transition-colors hover:text-gold"
                                                href="mailto:$Email"
                                                title="Email $Name"
                                            >
                                                <svg
                                                    class="h-[0.875rem]"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 512 512"
                                                    fill="currentColor"
                                                    ><path
                                                        d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"
                                                    />
                                                </svg>
                                                <span> $Email </span>
                                            </a>
                                        <% end_if %>
                                        <% if $Phone %>
                                            <a
                                                class="flex items-center justify-center gap-4 text-md text-heading transition-colors hover:text-gold"
                                                href="tel:$Phone"
                                                title="Call $Name"
                                            >
                                                <svg
                                                    class="h-[0.875rem]"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 512 512"
                                                    fill="currentColor"
                                                    ><path
                                                        d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"
                                                    />
                                                </svg>
                                                <span> $Phone </span>
                                            </a>
                                        <% end_if %>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                <% end_loop %>
            </div>
            <div class="swiper-prev absolute top-1/2 left-0 z-10 flex items-center justify-center w-11 h-11 bg-gold text-white hover:cursor-pointer [&.swiper-button-disabled]:opacity-30 [&.swiper-button-disabled]:cursor-default">
                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/500/svg" viewBox="0 0 320 512">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/>
                </svg>
            </div>
            <div class="swiper-next absolute top-1/2 right-0 z-10 flex items-center justify-center w-11 h-11 bg-gold text-white hover:cursor-pointer [&.swiper-button-disabled]:opacity-30 [&.swiper-button-disabled]:cursor-default">
                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                    <path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/>
                </svg>
            </div>
		</div>
	</div>
</section>