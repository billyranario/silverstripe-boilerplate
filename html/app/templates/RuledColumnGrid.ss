<section class="<% if $Shaded %>bg-cream <% end_if %>py-16 font-archivo md:py-20">
    <div class="container">
        <div class="flex flex-wrap items-end justify-between gap-2">
            <h2 class="text-2xl font-semibold text-heading md:text-3xl">$Heading</h2>
            <% if $Eyebrow %>
                <span class="text-xs uppercase tracking-[0.2em] text-gold">$Eyebrow</span>
            <% end_if %>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-8 md:grid-cols-3 md:gap-10">
            <% loop $Columns %>
                <div class="border-t border-heading pt-4">
                    <span class="text-xs uppercase tracking-[0.15em] text-body">$Label</span>
                    <h3 class="mt-2 text-lg font-semibold text-heading">$Title</h3>
                    <p class="mt-2 text-sm leading-6 text-body">$Content</p>
                </div>
            <% end_loop %>
        </div>
    </div>
</section>
