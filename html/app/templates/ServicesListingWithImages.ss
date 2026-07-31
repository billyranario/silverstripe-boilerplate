<section class="bg-[#f3f4f5] py-32">
	<div class="container">
		<% if $HeadingContent %>
			<div class="rte mx-auto max-w-[46.75rem] text-center">
				$HeadingContent
			</div>
			<div class="mx-auto my-6 h-[2px] w-32 bg-gold"></div>
		<% end_if %>
		<div class="inner-container pt-14">
			<div class="grid grid-cols-1 gap-8 md:grid-cols-2 xl:grid-cols-3">
                <% loop $ServiceCards %>
					<div id="$Title" class="group relative flex flex-col hover:shadow-md">
						<div
							class="absolute left-1/2 top-0 h-[5.375rem] w-[5.375rem] -translate-x-1/2 overflow-hidden bg-gold p-5"
						>
							<div
								class="absolute bottom-full left-0 z-0 h-full w-full bg-navy transition-all group-hover:bottom-0"
							></div>
							<div class="text-white [&>*]:relative [&>*]:z-10 [&_svg]:w-[2.875rem] [&_svg]:h-[2.875rem] [&_svg]:fill-current">
								$IconMarkup.Raw
							</div>
						</div>
						<img class="aspect-[4/3]" src="$CardImage.Link" alt="$CardImage.Title" />
						<div class="grow bg-navy p-35p text-center transition-colors group-hover:bg-white">
							<h2 class="mb-3 font-playfair text-2xl text-white group-hover:text-heading">
								$Title
							</h2>
							<p class="text-body-gray group-hover:text-body">
								$Content
							</p>
							<% if $ButtonLink %>
								<a
									class="animated-underline mt-6 text-sd font-bold uppercase text-gold after:h-[1px] group-hover:after:bg-gold"
									title="<% if $ButtonText %>$ButtonText<% else %>Read More<% end_if %>"
									href="/pratices/1">
									<% if $ButtonText %>
										$ButtonText
									<% else %>
										Read More
									<% end_if %>
								</a>
							<% end_if %>
						</div>
					</div>
                <% end_loop %>
			</div>
		</div>
	</div>
</section>
