<section
	class="flex h-full items-center bg-custom bg-navy bg-cover bg-no-repeat px-6 py-14 text-white md:h-screen md:min-h-[29.5rem] md:px-20 xl:min-h-[29.5rem] xl:px-64"
	<% if $BackgroundImage %>
		style="--bg-custom: url('$BackgroundImage.ScaleMaxWidth(1600).URL'); --bg-custom-sm: url('$BackgroundImage.FillMax(767, 928).URL');"
	<% end_if %>
>
	<div>
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
</section>
