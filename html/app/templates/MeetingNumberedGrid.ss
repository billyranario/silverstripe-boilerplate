<section id="$AnchorId" class="border-t border-meeting-navy/[14%]<% if $RuleBottom %> border-b<% end_if %> bg-meeting-paper py-[5.5rem] font-garamond">
    <div class="mx-auto max-w-[1180px] px-10">
        <div class="flex flex-wrap items-baseline justify-between gap-2">
            <span class="text-[11px] uppercase tracking-[0.24em] text-meeting-gold">$Eyebrow</span>
            <% if $ReferenceLabel %>
                <span class="text-[11px] uppercase tracking-[0.24em] text-meeting-gold">$ReferenceLabel</span>
            <% end_if %>
        </div>

        <h2 class="mt-3 max-w-[26ch] text-[1.7rem] font-medium leading-[1.12] text-meeting-navy md:text-[2.5rem]">$Heading</h2>

        <div class="mt-12 grid grid-cols-1 gap-x-10 gap-y-[52px] sm:grid-cols-2<% if $Columns == 3 %> md:grid-cols-3<% end_if %> md:gap-[64px]">
            <% loop $Items %>
                <article class="border-t border-meeting-navy pt-5">
                    <span class="text-[13px] font-medium text-meeting-gold">$Number</span>
                    <h3 class="mt-2 text-[23px] font-semibold leading-[1.2] text-meeting-navy">$Title</h3>
                    <p class="mt-2 text-[15px] leading-[1.5] text-meeting-body">$Description</p>
                </article>
            <% end_loop %>
        </div>
    </div>
</section>
