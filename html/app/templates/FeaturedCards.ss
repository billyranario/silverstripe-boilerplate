<section class="container grid grid-cols-1 gap-4 py-14 md:grid-cols-2 xl:grid-cols-2">
    <% loop Cards %>
        <div class="group/card flex flex-col">
            <div class="flex items-center bg-navy-light">
                <div class="flex h-20 w-20 items-center justify-center bg-gold text-white [&_svg]:fill-current [&_svg]:h-[3.125rem] [&_svg]:w-[3.125rem] [&_img]:w-[3.125rem]">
                    $IconMarkup.Raw
                </div>
                <h3 class="px-8 py-2 font-playfair text-[1.75rem] font-bold text-white">$Title</h3>
            </div>
            <div class="flex grow flex-col justify-between gap-6 bg-navy p-7">
                <p class="bg-navy text-body-gray">
                    $Content
                </p>
                <% if $ButtonLink %>
                    <a
                        class="group flex items-center gap-3 text-sd font-bold uppercase text-gold-light transition-all hover:text-white"
                        href="$ButtonLink"
                        title="$ButtonText"
                    >
                        <span>
                            <% if $ButtonText %>
                                $ButtonText
                            <% else %>
                                Find Out More
                            <% end_if %>
                        </span>
                        <svg
                            class="w-4 fill-current transition-all duration-300 group-hover:translate-x-2 group-hover:opacity-0"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"
                            ><path
                                d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"
                            />
                        </svg>
                    </a>
                <% end_if %>
            </div>
            <img
                class="grayscale transition-all duration-300 group-hover/card:grayscale-0"
                src="$Image.Link"
                alt="$Image.Title"
            />
        </div>
    <% end_loop %>
</section>
