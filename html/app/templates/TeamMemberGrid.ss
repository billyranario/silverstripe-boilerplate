<section class="pb-14">
    <% loop $TeamMembers %>
        <div id="$URI" class="container flex min-h-0 flex-col gap-10 bg-white py-16 md:flex-row md:gap-14">
            <div class="mb-7 md:hidden">
                <h1 class="mb-3 font-playfair text-5xl text-heading">$Name</h1>
                <h2 class="text-sd uppercase tracking-widest text-[#999]">$Role</h2>
            </div>
            <div class="flex flex-col">
                <img
                    class="object-cover min-h-[25rem] md:min-w-[23rem] w-[23rem]"
                    src="$Photo.Fit(1300, 800).URL"
                    alt="$Name"
                />
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
                <div class="mx-auto mt-6">
                    <% include SocialIcons %>
                </div>
            </div>
            <div>
                <div class="mb-7 hidden md:block">
                    <h1 class="mb-3 font-playfair text-5xl text-heading">$Name</h1>
                    <h2 class="text-sd uppercase tracking-widest text-[#999]">$Role</h2>
                </div>
                <div class="rte mb-8 md:w-8/12 text-justify">
                    $Bio
                </div>
                <% if $ExpertiseTags.exists %>
                    <div>
                        <h2 class="mb-5 font-playfair text-2xl">Expertise</h2>
                        <ul class="flex flex-wrap gap-5">
                            <% loop $ExpertiseTags %>
                            <li>
                                <a
                                    href="/about-us/our-services"
                                    class="inline-block rounded-full bg-[#2222221a] px-5 py-3 text-sd transition-colors hover:bg-gold hover:text-white"
                                    title="$Title"
                                    >$Title</a
                                >
                            </li>
                            <% end_loop %>
                        </ul>
                    </div>
                <% end_if %>
            </div>
        </div>
    <% end_loop %>
</seciton>
