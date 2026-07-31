<section class="inner-container pb-20 md:pb-28">
	<div class="flex flex-col gap-10">
		<% loop PaginatedJobs %>
			<a class="group flex flex-col shadow-lg md:flex-row" href="$Link" title="$Title">
				<div class="overflow-hidden w-full shrink-0 md:max-w-[20rem] lg:max-w-[28rem]">
					<img
						class="aspect-[5/3] h-full w-full object-cover transition-all md:aspect-square lg:aspect-[4/3]"
						src="$Image.Link"
						alt="$Image.Title"
					/>
				</div>
				<div class="p-6">
					<h3
						class="mb-5 font-playfair text-2xl font-bold text-heading transition-all group-hover:text-gold"
					>
						$Title
					</h3>
					<div class="rte text-body transition-all">
						<% if $Description %>
							$Description
						<% else %>
							$Content.Summary
						<% end_if %>
					</div>
					<span
						class="mt-8 flex items-center gap-4 text-sd font-bold uppercase tracking-wide text-gold"
					>
						<span> Read More </span>
						<svg
							class="w-4 fill-current transition-all group-hover:translate-x-2"
							xmlns="http://www.w3.org/2000/svg"
							viewBox="0 0 512 512"
							><path
								d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"
							/>
						</svg>
					</span>
				</div>
			</a>
		<% end_loop %>
	</div>
	<% if $PaginatedJobs.MoreThanOnePage %>
		<div class="my-10 flex justify-center space-x-4">
			<% if $PaginatedJobs.NotFirstPage %>
				<a class="px-4 py-2 text-heading border border-heading transition-colors hover:bg-navy hover:text-white" title="Previous" href="$PaginatedJobs.PrevLink">Previous</a>
			<% end_if %>
	
			<% loop $PaginatedJobs.Pages %>
				<a class="px-4 py-2 text-heading border border-heading transition-colors hover:bg-navy hover:text-white <% if $CurrentBool %>text-white bg-navy<% end_if %>" href="$Link" title="Go to $PageNum">$PageNum</a>
			<% end_loop %>
	
			<% if $PaginatedJobs.NotLastPage %>
				<a class="px-4 py-2 text-heading border border-heading transition-colors hover:bg-navy hover:text-white" title="Next" href="$PaginatedJobs.NextLink">Next</a>
			<% end_if %>
		</div>
	<% end_if %>
</section>
