<ul class="flex flex-wrap gap-4">
	<% if $Facebook %>
		<li>
			<a
				class="group flex h-11 w-11 items-center justify-center rounded-full bg-navy transition-colors hover:bg-gold"
				href="$SiteConfig.Facebook"
				target="_blank"
				title="Visit us on Facebook"
				rel="noreferrer noopener"
			>
				<svg
					class="h-[1.125rem] fill-current text-[#bbbec6] transition-colors group-hover:text-white"
					xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 320 512"
					><path
						d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z"
					/>
				</svg>
			</a>
		</li>
	<% end_if %>
	<% if $SiteConfig.LinkedIn %>
		<li>
			<a
				class="group flex h-11 w-11 items-center justify-center rounded-full bg-navy transition-colors hover:bg-gold"
				href="$SiteConfig.LinkedIn"
				target="_blank"
				title="Visit us on LinkedIn"
				rel="noreferrer noopener"
			>
				<svg
					class="h-[1.125rem] fill-current text-[#bbbec6] transition-colors group-hover:text-white"
					xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 448 512"
					><path
						d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"
					/>
				</svg>
			</a>
		</li>
	<% end_if %>
</ul>
