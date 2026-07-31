<% if $Layout == 'Half' %>
	<section class="grid grid-cols-1 xl:grid-cols-2">
		<div class="bg-cream p-6 md:p-20">
			<div class="rte">
				$Content
			</div>
		</div>
		<img class="h-full w-full object-cover" src="$Image.Link" alt="$Image.Title" />
	</section>
<% else_if $Layout == 'OneThird' %>
	<div class="bg-cream">
		<section class="container flex flex-col items-center gap-10 py-28 lg:flex-row">
			<img
				class="min-h-[31.25rem] object-cover lg:w-1/3"
				src="$Image.Link"
				alt="$Image.Title"
			/>
			<div class="rte">
				$Content
			</div>
		</section>
	</div>
<% end_if %>
