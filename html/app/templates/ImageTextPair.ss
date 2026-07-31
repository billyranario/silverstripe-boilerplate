<section class="container py-16 font-archivo md:py-20">
    <div class="grid grid-cols-1 items-center gap-10 md:grid-cols-2 md:gap-16">
        <% if $ImagePosition == 'Right' %>
            <div class="order-2 md:order-1">
                <% if $Eyebrow %>
                    <span class="text-xs uppercase tracking-[0.2em] text-gold">$Eyebrow</span>
                <% end_if %>
                <h2 class="mt-3 text-2xl font-semibold text-heading md:text-3xl">$Heading</h2>
                <div class="mt-5 text-sm leading-7 text-body [&_strong]:font-semibold [&_strong]:text-heading">$Content</div>
            </div>
            <div class="order-1 md:order-2">
                <% if $Image %>
                    <img class="h-full w-full min-h-[22rem] object-cover" src="$Image.Fill(900, 700).URL" alt="$Image.Title" />
                <% end_if %>
            </div>
        <% else %>
            <div class="order-1">
                <% if $Image %>
                    <img class="h-full w-full min-h-[22rem] object-cover" src="$Image.Fill(900, 700).URL" alt="$Image.Title" />
                <% end_if %>
            </div>
            <div class="order-2">
                <% if $Eyebrow %>
                    <span class="text-xs uppercase tracking-[0.2em] text-gold">$Eyebrow</span>
                <% end_if %>
                <h2 class="mt-3 text-2xl font-semibold text-heading md:text-3xl">$Heading</h2>
                <div class="mt-5 text-sm leading-7 text-body [&_strong]:font-semibold [&_strong]:text-heading">$Content</div>
            </div>
        <% end_if %>
    </div>
</section>
