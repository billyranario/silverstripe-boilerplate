<section id="$AnchorId" class="bg-white py-[5.5rem] font-garamond">
    <div class="mx-auto max-w-[1180px] px-10">
        <span class="text-[11px] uppercase tracking-[0.24em] text-meeting-gold">$Eyebrow</span>

        <div class="mt-8 grid grid-cols-1 gap-[26px] md:grid-cols-3">
            <% loop $Tiles %>
                <div>
                    <% if $Image %>
                        <img class="h-[280px] w-full bg-meeting-placeholder object-cover" src="$Image.Fill(600,280).URL" alt="$Alt" loading="lazy">
                    <% end_if %>
                    <p class="mt-4 text-[19px] font-medium text-meeting-navy">$Title</p>
                    <p class="text-[11px] uppercase tracking-[0.16em] text-meeting-muted">$Caption</p>
                </div>
            <% end_loop %>
        </div>
    </div>
</section>
