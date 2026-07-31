<section class="bg-navy-dark py-16 font-archivo md:py-20">
    <div class="container">
        <div class="max-w-3xl">
            <% if $Eyebrow %>
                <span class="text-xs uppercase tracking-[0.2em] text-gold-light">$Eyebrow</span>
            <% end_if %>

            <h1 class="mt-5 text-4xl font-semibold leading-tight text-white md:text-5xl">$Heading</h1>

            <% if $Lede %>
                <div class="mt-7 text-base leading-7 text-white/70">$Lede</div>
            <% end_if %>

            <% if $ReferenceLine %>
                <p class="mt-8 text-sm leading-6 text-white/60 [&_b]:font-semibold [&_b]:text-gold-light [&_strong]:font-semibold [&_strong]:text-gold-light">$ReferenceLine</p>
            <% end_if %>
        </div>
    </div>
</section>
