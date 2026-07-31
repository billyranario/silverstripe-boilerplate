<section class="container py-10 font-archivo">
    <div class="border border-gray-border px-8 py-6">
        <p>
            <% if $Eyebrow %>
                <span class="text-xs uppercase tracking-[0.15em] text-gold">$Eyebrow</span>
            <% end_if %>
            <span class="ml-3 text-base font-semibold text-heading">$Heading</span>
        </p>
        <p class="mt-3 text-sm leading-7 text-body">$Content</p>
    </div>
</section>
