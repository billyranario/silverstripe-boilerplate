<section class="container py-16 font-archivo md:py-20">
    <div class="flex flex-wrap items-end justify-between gap-2">
        <h2 class="text-2xl font-semibold text-heading md:text-3xl">$Heading</h2>
        <% if $Eyebrow %>
            <span class="text-xs uppercase tracking-[0.2em] text-gold">$Eyebrow</span>
        <% end_if %>
    </div>

    <div class="mt-8 grid grid-cols-2 gap-x-6 gap-y-8 md:grid-cols-6">
        <% loop $Members %>
            <div>
                <% if $Photo %>
                    <img
                        class="aspect-square w-full object-cover"
                        src="$Photo.Fill(300, 300).URL"
                        alt="$Name"
                    />
                <% end_if %>
                <p class="mt-3 text-sm font-semibold text-heading">$Name</p>
                <p class="text-xs text-body">$Role</p>
            </div>
        <% end_loop %>
    </div>

    <% if $Caption %>
        <p class="mt-8 text-sm leading-6 text-body">$Caption</p>
    <% end_if %>
</section>
