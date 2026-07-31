<header
    data-segment="$URLSegment"
    class="fixed bg-white bg-opacity-1 <% if $URLSegment == 'home' || $URLSegment == 'contact' || $URLSegment == 'blog' %>top-0<% else %>top-8<% end_if %> z-40 w-full transition-[top] duration-300 ease-in-out"
>
    <div class="container flex h-[6.875rem] justify-between px-15">
        <div class="h-full py-4">
            <a href="/">
                <div class="w-[12rem]"> 
                    <img
                        src="/assets/Uploads/MMP_CMYK.webp"
                        alt="MMP Logo"
                        class="w-full"
                    />
                </div>
            </a>
        </div>
        <div class="flex gap-10">
            <nav class="hidden md:block md:pr-8">
                <!-- Desktop Nav Menu -->
                <ul
                    class="flex h-full gap-8 font-playfair text-base font-bold text-heading"
                >
                    <% loop $Menu(1) %>
                    <li class="group relative">
                        <a
                            class="group font-montserrat font-normal flex h-full items-center uppercase transition-all hover:text-gold [&.current]:text-gold <% if $isCurrent %>current<% end_if %>"
                            href="$Link"
                            title="Go to $MenuTitle page"
                        >
                            <span class="fadein-underline">$MenuTitle</span>
                        </a>

                        <% if $Children.exists %>
                        <!-- Desktop Sub Menu -->
                        <div
                            class="absolute z-50 left-0 top-full grid min-w-56 grid-rows-[0fr] overflow-hidden bg-white px-35p transition-all group-hover:grid-rows-[1fr] group-hover:py-15p group-hover:shadow-dropdown"
                        >
                            <ul class="min-h-0 font-medium">
                                <% loop $Children %>
                                <li class="group/submenu relative">
                                    <a
                                        class="relative block font-montserrat font-normal border-b border-gray-light pb-2 pt-3 text-gray-dark transition-colors hover:text-gold group-last/submenu:border-b-0 [&.current]:text-gold <% if $isCurrent %>current<% else_if $isSection %>section<% end_if %>"
                                        href="$Link"
                                        title="Go to $MenuTitle page"
                                    >
                                        $MenuTitle
                                        <span
                                            class="absolute left-0 top-full z-10 h-[1px] w-0 origin-left transform bg-gold transition-all duration-300 ease-in-out group-hover/submenu:w-full"
                                        ></span>
                                    </a>
                                </li>
                                <% end_loop %>
                            </ul>
                        </div>
                        <% end_if %>
                    </li>
                    <% end_loop %>
                </ul>
            </nav>

            <!----- Mobile Nav ------>
            <!-- Mobile Menu Toggle -->
            <button
                class="mobile-nav-toggle group block md:hidden"
                title="Toggle mobile menu"
            >
                <svg
                    class="w-9 fill-current text-heading transition-colors group-hover:text-gold"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512"
                >
                    <path
                        d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"
                    />
                </svg>
            </button>
            <!-- Modal -->
            <div
                class="mobile-modal pointer-events-none invisible fixed inset-0 z-20 h-screen w-screen bg-semitransparent opacity-0 [&.active]:pointer-events-auto [&.active]:visible [&.active]:opacity-100"
                title="Close mobile menu"
                role="button"
            ></div>
            <!-- Mobile Menu -->
            <div
                class="mobile-menu no-scrollbar pointer-events-none invisible fixed left-0 top-0 z-30 h-full min-h-screen w-full max-w-md -translate-x-full overflow-y-scroll bg-navy px-8 py-5 text-white opacity-0 transition-all duration-300 md:hidden [&.active]:pointer-events-auto [&.active]:visible [&.active]:translate-x-0 [&.active]:opacity-100"
            >
                <button
                    class="mobile-menu-close group mb-6 ml-auto block"
                    title="Close mobile menu"
                >
                    <svg
                        class="w-6 fill-current text-white transition-all group-hover:text-gold"
                        title="Toggle Mobile Menu"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 384 512"
                    >
                        <path
                            d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
                        />
                    </svg>
                </button>
                <ul>
                    <% loop Menu(1) %> <% if $Children.exists %>
                    <li class="mobile-submenu">
                        <button
                            class="submenu-toggle group flex w-full items-center justify-between gap-10 py-3 text-[1.0625rem] transition-colors hover:text-gold"
                            title="View $MenuTitle sub pages"
                        >
                            <span>$MenuTitle</span>
                            <svg
                                class="w-3 fill-current transition-transform group-[.active]:rotate-180"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 320 512"
                            >
                                <path
                                    d="M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z"
                                />
                            </svg>
                        </button>
                        <!-- Mobile Submenu -->
                        <div
                            class="submenu grid grid-rows-[0fr] overflow-hidden transition-all duration-300 [&.active]:grid-rows-[1fr]"
                        >
                            <ul class="ml-4 min-h-0 text-md">
                                <% loop $Children %>
                                <li>
                                    <a
                                        class="block py-2 transition-colors hover:text-gold"
                                        href="$Link"
                                        title="Go to $MenuTitle page"
                                        >$MenuTitle</a
                                    >
                                </li>
                                <% end_loop %>
                            </ul>
                        </div>
                    </li>
                    <% else %>
                    <li>
                        <a
                            class="block py-3 text-[1.0625rem] transition-colors hover:text-gold"
                            href="$Link"
                            title="Go to $MenuTitle page"
                        >
                            $MenuTitle
                        </a>
                    </li>
                    <% end_if %> <% end_loop %>
                </ul>
                <div class="mx-auto my-8 h-[1px] w-full bg-body"></div>
                <ul>
                    <li>
                        <a
                            class="flex items-center gap-4 py-3 transition-colors hover:text-gold"
                            href="tel:$SiteConfig.ContactNumber"
                        >
                            <svg
                                class="h-[0.875rem] text-gold"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"
                                fill="currentColor"
                            >
                                <path
                                    d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"
                                />
                            </svg>
                            <span>$SiteConfig.ContactNumber</span>
                        </a>
                    </li>
                    <li>
                        <a
                            class="flex items-center gap-4 py-3 transition-colors hover:text-gold"
                            href="mailto:$SiteConfig.ContactEmail"
                        >
                            <svg
                                class="h-[0.875rem] text-gold"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512"
                                fill="currentColor"
                            >
                                <path
                                    d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"
                                />
                            </svg>
                            <span>$SiteConfig.ContactEmail</span>
                        </a>
                    </li>
                    <li>
                        <a
                            class="flex items-center gap-4 py-3 transition-colors hover:text-gold"
                            href="$SiteConfig.AddressLink"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <svg
                                class="h-[0.875rem] text-gold"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 384 512"
                                fill="currentColor"
                            >
                                <path
                                    d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"
                                />
                            </svg>
                            <span>$SiteConfig.Address</span>
                        </a>
                    </li>
                </ul>
                <div class="mx-auto my-8 h-[1px] w-full bg-body"></div>
                <% include SocialIcons Facebook=$SiteConfig.Facebook %>
            </div>
        </div>
    </div>
</header>
