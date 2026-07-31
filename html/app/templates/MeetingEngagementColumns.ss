<section class="bg-meeting-paper py-[5.5rem] font-garamond">
    <div class="mx-auto max-w-[1180px] px-10">
        <span class="text-[11px] uppercase tracking-[0.24em] text-meeting-gold">$Eyebrow</span>
        <h2 class="mt-3 max-w-[26ch] text-[1.7rem] font-medium leading-[1.12] text-meeting-navy md:text-[2.5rem]">$Heading</h2>

        <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-3">
            <% loop $Stages %>
                <article class="border-l border-meeting-navy pl-[26px]">
                    <span class="text-[11px] uppercase tracking-[0.16em] text-meeting-muted">$Label</span>
                    <h3 class="mt-2 text-[23px] font-semibold leading-[1.2] text-meeting-navy">$Title</h3>
                    <p class="mt-2 text-[15px] leading-[1.5] text-meeting-body">$Description</p>
                </article>
            <% end_loop %>
        </div>
    </div>
</section>
