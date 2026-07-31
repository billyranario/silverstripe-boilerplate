<section class="bg-navy">
    <div class="px-0">
        <% if $Slides.Count == 1 %>
            <div
                class="relative flex h-[70vh] w-full items-center bg-navy bg-custom bg-cover bg-no-repeat px-6 py-14 text-white md:h-[90vh] md:min-h-[29.5rem] md:px-20 xl:min-h-[29.5rem] xl:px-64"
                <% if $BackgroundImage %>
                    style="--bg-custom: url('$BackgroundImage.URL'); --bg-custom-sm: url('$BackgroundImage.FillMax(520, 500).URL');"
                <% end_if %>
            >
                <% if $BackgroundImage %>
                    <div class="absolute z-0 inset-0 bg-semitransparent-md"></div>
                <% end_if %>
                <div class="reltaive z-10">
                    <div class="rte hero dark">
                        $Content
                    </div>
                    <div class="mt-12 flex flex-wrap gap-5">
                        <% loop Buttons %>
                            <% if $Theme == 'Primary' %>
                                <a
                                    class="btn border border-white bg-white font-normal text-navy transition-all before:bg-gold hover:border-gold hover:text-white"
                                    href="$Link"
                                >
                                    <div class="relative z-10 flex gap-3">
                                        <span> $Text </span>
                                        <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                            ><path
                                                d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"
                                            />
                                        </svg>
                                    </div>
                                </a>
                            <% else_if $Theme == 'Secondary' %>
                                <a
                                    class="relative inline-block border border-white bg-transparent px-35p py-10p text-sm uppercase leading-[2.5] tracking-[1.5px] text-white transition-colors hover:bg-white hover:text-navy"
                                    href="$Link"
                                >
                                    $Text
                                </a>
                            <% end_if %>
                        <% end_loop %>
                    </div>
                </div>
            </div>    
        <% else %>
            <div class="hero-carousel swiper h-[70vh] md:h-[90vh]">
                <div class="swiper-wrapper">
                    <% loop $Slides %>
                        <div
                            class="swiper-slide relative flex h-auto w-full items-center bg-navy bg-custom bg-cover bg-no-repeat px-6 py-14 text-white md:min-h-[29.5rem] md:px-20 xl:min-h-[29.5rem] xl:px-64"
                            <% if $BackgroundImage %>
                                style="--bg-custom: url('$BackgroundImage.ScaleMaxWidth(2000).URL'); --bg-custom-sm: url('$BackgroundImage.FillMax(520, 500).URL');"
                            <% end_if %>
                        >
                            <% if $BackgroundImage %>
                                <div class="absolute z-0 inset-0 bg-semitransparent-md"></div>
                            <% end_if %>
                            <div class="reltaive z-10">
                                <div class="rte hero dark">
                                    $Content
                                </div>
                                <div class="mt-12 flex flex-wrap gap-5">
                                    <% loop Buttons %>
                                        <% if $Theme == 'Primary' %>
                                            <a
                                                class="btn border border-white bg-white font-normal text-navy transition-all before:bg-gold hover:border-gold hover:text-white"
                                                title="$Text"
                                                href="$Link"
                                            >
                                                <div class="relative z-10 flex gap-3">
                                                    <span> $Text </span>
                                                    <svg class="w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                        ><path
                                                            d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"
                                                        />
                                                    </svg>
                                                </div>
                                            </a>
                                        <% else_if $Theme == 'Secondary' %>
                                            <a
                                                class="relative inline-block border border-white bg-transparent px-35p py-10p text-sm uppercase leading-[2.5] tracking-[1.5px] text-white transition-colors hover:bg-white hover:text-navy"
                                                href="$Link"
                                                title="$Text"
                                            >
                                                $Text
                                            </a>
                                        <% end_if %>
                                    <% end_loop %>
                                </div>
                            </div>
                        </div>
                    <% end_loop %>
                </div>
            </div>
        <% end_if %>
    </div>
</section>