<% with $BlogPost %>
	<div class="bg-navy bg-cover bg-no-repeat text-white">
		<div class="container py-20 lg:py-32">
			<h1 class="text-center font-playfair text-5xl md:text-6xl">
				$Title
			</h1>
		</div>
	</div>

	<main class="inner-container grid py-28">
		<div>
			<img
				class="mb-8 max-h-[27.5rem] w-full object-cover"
				src="$Image.Link"
				alt="$Image.Title"
			/>
			<div
				class="flex flex-wrap items-center gap-5 py-1 text-[0.8125rem] uppercase tracking-wide [&>*]:border-r [&>*]:border-gray-border [&>*]:pr-5 last:[&>*]:border-0"
			>
				<span class="flex items-center gap-2">
					<img
						class="h-8 w-8 rounded-full object-cover"
						src="$Author.Photo.Link"
						alt="$Author.Photo.Title"
					/>
					<span> By $Author.Name </span>
				</span>
				<span class="flex items-center gap-2">
					<svg
						class="h-4 fill-current text-navy"
						xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 448 512"
						><path
							d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192H400V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192z"
						/>
					</svg>
					<span>$FullDateCreated</span>
				</span>
				<span class="flex items-center gap-2">
					<svg
						class="h-4 fill-current text-navy"
						xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 512 512"
						><path
							d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"
						/>
					</svg>
					<span class="flex gap-2">
						<% loop $Categories %>
							<a class="transition-colors hover:text-gold" href="$Link">$Name</a>
						<% end_loop %>
					</span>
				</span>
			</div>
			<div class="rte border-b border-gray-border pb-10 pt-6">
				$Content
			</div>
		</div>
	<% end_with %>
	<%-- <% include BlogAside Categories=$AllCategories, LatestBlogPosts=$LatestBlogPosts, Tags=$AllTags %> --%>
	</main>
