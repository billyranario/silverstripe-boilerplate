<section class="bg-white py-[5.5rem] font-garamond">
    <div class="mx-auto max-w-[1180px] px-10">
        <div class="grid grid-cols-1 items-center gap-[72px] md:grid-cols-[1.05fr_0.95fr]">
            <div>
                <% if $Eyebrow %>
                    <span class="text-[11px] uppercase tracking-[0.24em] text-meeting-gold">$Eyebrow</span>
                <% end_if %>

                <h1 class="mt-4 text-[2.2rem] font-medium leading-[1.04] tracking-[-0.01em] text-meeting-navy md:text-[3.9rem]">$Heading</h1>

                <% if $LedeOne %>
                    <div class="mt-7 max-w-[33em] text-[19px] leading-[1.5] text-meeting-body">$LedeOne</div>
                <% end_if %>
                <% if $LedeTwo %>
                    <div class="mt-5 max-w-[33em] text-[19px] leading-[1.5] text-meeting-body">$LedeTwo</div>
                <% end_if %>

                <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3">
                    <% if $CtaLink %>
                        <a class="inline-block bg-meeting-navy px-8 py-4 text-sm font-medium uppercase tracking-[0.15em] text-white transition-colors hover:bg-meeting-navy-hover" href="$CtaLink" title="$CtaText">
                            $CtaText
                        </a>
                    <% end_if %>
                    <% if $PhoneLink %>
                        <a class="text-sm text-meeting-body underline underline-offset-4 hover:text-meeting-gold" href="$PhoneLink">$PhoneText</a>
                    <% end_if %>
                </div>

                <% if $ReferenceLine %>
                    <p class="mt-10 border-t border-meeting-navy/[14%] pt-5 text-[11px] uppercase tracking-[0.16em] text-meeting-muted">$ReferenceLine</p>
                <% end_if %>
            </div>

            <% if $Image %>
                <div>
                    <img class="h-[320px] w-full bg-meeting-placeholder object-cover md:h-[520px]" src="$Image.Fill(900,1040).URL" alt="$ImageAlt" fetchpriority="high">
                </div>
            <% end_if %>
        </div>
    </div>
</section>
