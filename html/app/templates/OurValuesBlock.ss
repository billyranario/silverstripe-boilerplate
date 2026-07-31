<section class="bg-cover bg-no-repeat" style="background: url('$themedResourceURL('/images/contract-signing.jpg')'); background-repeat: no-repeat; background-size: cover;">
	<div class="h-full w-full bg-navy-semitransparent py-20 xl:py-24">
		<div class="container flex flex-col items-center gap-14 xl:flex-row xl:gap-0">
			<% loop $OurValues %>
				<div
					class="flex flex-col items-center border-r-0 border-[#545967] px-9 text-center last:border-r-0 xl:border-r"
				>
					<div class="mb-3 [&_svg]:h-[4.5rem] [&_svg]:fill-current [&_svg]:text-gold">
						$IconMarkup.Raw
					</div>
					<h1 class="mb-3 font-playfair text-2xl text-white">$Title</h1>
					<div class="rte dark">
						<p>
							$Content
						</p>
					</div>
				</div>
			<% end_loop %>
		</div>
	</div>
</section>
