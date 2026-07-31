<section class="bg-[#f3f4f5] py-32">
    <div class="container">
        <% if $HeadingContent %>
            <div class="rte mx-auto max-w-[46.75rem] text-center">
                $HeadingContent
            </div>
            <div class="mx-auto my-6 h-[2px] w-32 bg-gold"></div>
        <% end_if %>
        <div
            class="inner-container bg-[top_right] bg-no-repeat <% if $HeadingContent %> pt-14 <% end_if %>"
        >
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                <% loop $ServiceCards %>
                    <a href="/about-us/our-services" class="group" title="$Title">
                        <div class="group relative border border-body-gray bg-white">
                            <div class="animated-clip relative z-10 h-full">
                                <div class="relative z-10 flex flex-col items-center p-35p text-center">
                                    <h2 class="font-playfair text-2xl text-heading group-hover:text-white">$Title</h2>
                                    <div
                                        class="mb-6 mt-4 flex h-[5.375rem] w-[5.375rem] items-center justify-center rounded bg-navy text-white group-hover:bg-gold [&_svg]:w-[3.125rem] [&_svg]:fill-current [&_img]:w-[3.125rem]"
                                    >
                                        $IconMarkup.Raw
                                    </div>
                                    <p class="text-body group-hover:text-body-gray">
                                        $Content
                                    </p>
                                    <% if $ButtonLink %>
                                        <a
                                            class="animated-underline mt-6 text-sd font-bold uppercase text-gold after:h-[1px] group-hover:text-white group-hover:after:bg-white"
                                            href="$ButtonLink"
                                            title="$ButtonText">
                                            <% if $ButtonText %>
                                                $ButtonText
                                            <% else %>
                                                Read More
                                            <% end_if %>
                                        </a
                                        >
                                    <% end_if %>
                                </div>
                            </div>
                        </div>
                    </a>
                <% end_loop %>
            </div>
        </div>
    </div>
</section>
