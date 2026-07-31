<aside class="space-y-10 text-heading">
	<% if $Categories %>
		<div>
			<h2 class="heading-cut bg-navy px-6 py-15p font-playfair text-2xl font-bold text-white">
				Categories
			</h2>
			<ul
				class="list-square-gold border border-t-0 border-gray-border px-6 py-3 text-sm uppercase tracking-wider"
			>
				<% loop $Categories %>
					<li class="group cursor-pointer border-b border-gray-border last:border-0">
						<a
							class="peer block w-full py-5 transition-colors group-hover:text-gold"
							href="$Link">$Name</a
						>
						<span
							class="absolute left-0 top-full z-10 h-[1px] w-0 origin-left transform bg-navy transition-all duration-300 ease-in-out group-last:hidden peer-hover:w-full"
						></span>
					</li>
				<% end_loop %>
			</ul>
		</div>
	<% end_if %>
	<% if $LatestBlogPosts %>
		<div>
			<h2 class="heading-cut bg-navy px-6 py-15p font-playfair text-2xl font-bold text-white">
				Recent Posts
			</h2>
			<ul class="border border-t-0 border-gray-border px-6 py-7">
				<% loop $LatestBlogPosts %>
					<li
						class="cursor-pointer border-b border-gray-border py-5 first:pt-0 last:border-0 last:pb-0"
					>
						<a class="group flex gap-5" href="$Link">
							<img class="w-20" src="$Image.Link" alt="$Image.Title" />
							<div>
								<div class="mb-1 flex items-center gap-3 text-body">
									<svg class="h-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
										><path
											d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192H400V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192z"
										/>
									</svg>
									<span class="text-[0.8125rem] uppercase leading-5"> $FullDateCreated </span>
								</div>
								<h3
									class="line-clamp-2 font-playfair text-lg font-bold transition-colors group-hover:text-gold"
								>
									$Title
								</h3>
							</div>
						</a>
					</li>
				<% end_loop %>
			</ul>
		</div>
	<% end_if %>
	<% if $Tags %>
		<div>
			<h2 class="heading-cut bg-navy px-6 py-15p font-playfair text-2xl font-bold text-white">
				Tags
			</h2>
			<ul class="flex flex-wrap gap-3 border border-t-0 border-gray-border px-6 py-7">
				<% loop $Tags %>
					<li>
						<a
							class="inline-block bg-[#2222221a] px-5 py-3 text-[0.8125rem] transition-colors hover:bg-gold hover:text-white"
							href="$Link">$Name</a
						>
					</li>
				<% end_loop %>
			</ul>
		</div>
	<% end_if %>
	<div>
		<h2 class="heading-cut bg-navy px-6 py-15p font-playfair text-2xl font-bold text-white">
			Newsletter
		</h2>
		<form class="border border-t-0 border-gray-border px-6 py-7">
			<input class="input" placeholder="Email" type="email" />
			<button
				class="mt-4 flex w-full items-center justify-center gap-4 bg-gold px-35p py-10p text-sm font-bold uppercase leading-9 tracking-widest text-white"
			>
				<span> Subscribe Now </span>
				<svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
					><path
						d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"
					/>
				</svg>
			</button>
		</form>
	</div>
</aside>
