<section class="container py-16 font-archivo md:py-20">
    <div class="border border-gray-border">
        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-gray-border px-8 py-5">
            <span class="text-xs uppercase tracking-[0.15em] text-heading">$Eyebrow</span>
            <% if $ReferenceLabel %>
                <span class="text-xs uppercase tracking-[0.15em] text-gold">$ReferenceLabel</span>
            <% end_if %>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2">
            <% loop $Items %>
                <div class="border-gray-border px-8 py-8<% if $IsLeftColumn %> md:border-r<% end_if %><% if $NeedsTopDivider %> md:border-t<% end_if %>">
                    <span class="text-sm text-gold">$Number</span>
                    <h3 class="mt-2 text-lg font-semibold text-heading">$Title</h3>
                    <p class="mt-2 text-sm leading-6 text-body">$Content</p>
                </div>
            <% end_loop %>
        </div>

        <% if $FooterNote %>
            <div class="border-t border-gray-border bg-cream px-8 py-5 text-sm leading-6 text-body [&_strong]:font-semibold [&_strong]:text-heading">
                $FooterNote
            </div>
        <% end_if %>
    </div>
</section>
