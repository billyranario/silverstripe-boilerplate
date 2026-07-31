<section id="$AnchorId" class="bg-white py-[5.5rem] font-garamond">
    <div class="mx-auto max-w-[1180px] px-10">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-[0.9fr_1.1fr]">
            <div>
                <span class="text-[11px] uppercase tracking-[0.24em] text-meeting-gold">$Eyebrow</span>
                <h2 class="mt-3 text-[1.7rem] font-medium leading-[1.12] text-meeting-navy md:text-[2.5rem]">$Heading</h2>
            </div>
            <% if $SupportingText %>
                <p class="self-end text-[17px] leading-[1.5] text-meeting-body">$SupportingText</p>
            <% end_if %>
        </div>

        <div class="mt-10 grid grid-cols-2 gap-x-[22px] gap-y-8 md:grid-cols-6">
            <% loop $Picks %>
                <% if $TeamMember %>
                    <div>
                        <div class="relative aspect-[3/4] overflow-hidden bg-meeting-placeholder">
                            <% if $TeamMember.Photo %>
                                <img class="h-full w-full object-cover grayscale" src="$TeamMember.Photo.Fill(400,533).URL" alt="$TeamMember.Name" loading="lazy">
                            <% end_if %>
                            <div class="pointer-events-none absolute inset-0 bg-meeting-navy/90 mix-blend-color"></div>
                        </div>
                        <p class="mt-3 text-[15px] font-medium text-meeting-navy">$TeamMember.Name</p>
                        <p class="text-[11px] uppercase tracking-[0.16em] text-meeting-muted">$DisplayRole</p>
                    </div>
                <% end_if %>
            <% end_loop %>
        </div>
    </div>
</section>
