<div class="sponsor-carousel p-14">
	<% loop $Sponsors %>
		<div class="carousel-cell mr-20">
			<% if $Link %>
				<a class="group inline-block" href="$Link" title="Visit $Name's website" target="_blank" rel="noreferrer noopener">
					<img
						class="h-14 max-w-64 opacity-70 grayscale transition-all group-hover:opacity-100 group-hover:grayscale-0"
						src="$Logo.Link"
						alt="$Name"
					/>
				</a>
			<% else %>
				<span class="group inline-block">
					<img
						class="h-14 max-w-64 opacity-70 grayscale transition-all group-hover:opacity-100 group-hover:grayscale-0"
						src="$Logo.Link"
						alt="$Name"
					/>
				</span>
			<% end_if %>
		</div>
	<% end_loop %>
</div>
