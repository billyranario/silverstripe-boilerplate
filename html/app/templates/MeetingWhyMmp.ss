<section class="bg-white py-[5.5rem] font-garamond">
    <div class="mx-auto max-w-[1180px] px-10">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-[0.9fr_1.1fr]">
            <div>
                <span class="text-[11px] uppercase tracking-[0.24em] text-meeting-gold">$Eyebrow</span>
                <h2 class="mt-3 text-[1.7rem] font-medium leading-[1.12] text-meeting-navy md:text-[2.5rem]">$Heading</h2>
            </div>

            <div>
                <% if $ParagraphOne %>
                    <div class="text-[17px] leading-[1.5] text-meeting-body">$ParagraphOne</div>
                <% end_if %>
                <% if $ParagraphTwo %>
                    <div class="mt-5 text-[17px] leading-[1.5] text-meeting-body">$ParagraphTwo</div>
                <% end_if %>

                <% if $TestimonialQuote %>
                    <blockquote class="mt-8 border-t border-meeting-navy/[14%] pt-6 italic text-meeting-navy">
                        <p class="text-[19px] leading-[1.5]">&ldquo;$TestimonialQuote&rdquo;</p>
                        <% if $TestimonialAttribution %>
                            <cite class="mt-2 block text-[13px] not-italic uppercase tracking-[0.14em] text-meeting-muted">— $TestimonialAttribution</cite>
                        <% end_if %>
                    </blockquote>
                <% end_if %>
            </div>
        </div>
    </div>
</section>
