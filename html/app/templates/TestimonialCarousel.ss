<section 
    class="<% if $BackgroundImage %> bg-cover bg-no-repeat <% else %> bg-navy <% end_if %>"
    <% if $BackgroundImage %>
        style="background-image: url('$BackgroundImage.Link');"
    <% end_if %>
    >
	<div class="bg-semitransparent-light">
		<div class="inner-container py-24 text-center text-white">
			<div class="flex flex-col items-center">
				<span class="uppercase tracking-[0.1875rem] text-gold">Testimonials</span>
				<h1 class="mb-6 mt-4 font-playfair text-5xl font-bold">What Clients Say About Us?</h1>
				<svg
					class="w-8 fill-current text-gold"
					xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 448 512"
					><path
						d="M448 296c0 66.3-53.7 120-120 120h-8c-17.7 0-32-14.3-32-32s14.3-32 32-32h8c30.9 0 56-25.1 56-56v-8H320c-35.3 0-64-28.7-64-64V160c0-35.3 28.7-64 64-64h64c35.3 0 64 28.7 64 64v32 32 72zm-256 0c0 66.3-53.7 120-120 120H64c-17.7 0-32-14.3-32-32s14.3-32 32-32h8c30.9 0 56-25.1 56-56v-8H64c-35.3 0-64-28.7-64-64V160c0-35.3 28.7-64 64-64h64c35.3 0 64 28.7 64 64v32 32 72z"
					/>
				</svg>
			</div>
			<div class="testimonial-carousel mt-9">
                <% loop Testimonials %>
                    <figure class="carousel-cell text-center md:px-32">
                        <blockquote class="font-playfair text-xl font-semibold space-y-4">
                            $Content
                        </blockquote>
                        <figcaption class="mt-9 flex flex-col items-center">
                            <% if $Photo %>
                                <img
                                class="w-16 rounded-full border border-gold"
                                src="$Photo.Link"
                                alt="$Name"
                            />
                            <% end_if %>
                            <div class="mt-4 space-y-2">
                                <span class="block font-semibold uppercase">$Name</span>
                                <span class="block text-sm text-body-gray">$Company</span>
                            </div>
                        </figcaption>
                    </figure>
                <% end_loop %>
			</div>
		</div>
	</div>
</section>