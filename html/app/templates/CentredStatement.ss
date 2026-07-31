<% if $MobileSpacingCSS || $TabletSpacingCSS || $DesktopSpacingCSS %>
    <style>
        .fr-block-$ID { $MobileSpacingCSS }
        @media (min-width: 768px) { .fr-block-$ID { $TabletSpacingCSS } }
        @media (min-width: 1280px) { .fr-block-$ID { $DesktopSpacingCSS } }
    </style>
<% end_if %>
<% if $Variant == 'Meeting' %>
    <%-- /meeting (Private Vendor Counsel, VC·26) closing band — own
         navy/gold tokens and EB Garamond, distinct hex values from the
         site's own Navy branch above and from Dark/Light. Own branch
         so none of the others are touched. --%>
    <section class="bg-meeting-navy<% if $Ruled %> border-t border-meeting-navy<% end_if %> py-[5.5rem] text-center font-garamond">
        <div class="mx-auto max-w-[900px] px-10">
            <% if $Eyebrow %>
                <span class="text-[11px] uppercase tracking-[0.24em] text-meeting-gold-on-navy">$Eyebrow</span>
            <% end_if %>

            <h2 class="mb-6 mt-3 text-[2rem] font-medium leading-[1.12] text-white md:text-[3rem]">$Heading</h2>

            <% if $Prose %>
                <div class="mx-auto max-w-[33em] text-[19px] leading-[1.5] text-white/80">
                    $Prose
                </div>
            <% end_if %>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-x-6 gap-y-3">
                <% if $ButtonLink %>
                    <a class="inline-block bg-white px-8 py-4 text-sm font-medium uppercase tracking-[0.15em] text-meeting-navy transition-colors hover:bg-meeting-gold-on-navy hover:text-white" href="$ButtonLink" title="$ButtonText">
                        $ButtonText
                    </a>
                <% end_if %>
                <% if $SecondaryLink %>
                    <a class="text-sm text-white/70 underline underline-offset-4 hover:text-meeting-gold-on-navy" href="$SecondaryLink">$SecondaryText</a>
                <% end_if %>
            </div>

            <% if $FootnoteLine %>
                <p class="mt-8 text-sm leading-6 text-white/60 [&_a]:text-white [&_a]:hover:text-meeting-gold-on-navy">$FootnoteLine</p>
            <% end_if %>
        </div>
    </section>
<% else_if $Variant == 'Navy' %>
    <%-- "MMP Landing Redesign" palette — plain Tailwind, site's own
         navy/gold/cream tokens. Kept as its own branch rather than
         extending the fr-* classes above, which are hard-wired to the
         champagne/graphite palette. --%>
    <section class="bg-navy-dark<% if $Ruled %> border-t border-navy-light<% end_if %> py-16 text-center font-archivo md:py-20">
        <div class="container">
            <div class="mx-auto max-w-3xl">
                <% if $Eyebrow %>
                    <span class="text-xs uppercase tracking-[0.2em] text-gold-light">$Eyebrow</span>
                <% end_if %>

                <h2 class="mb-6 mt-3 text-3xl font-semibold text-white md:text-4xl">$Heading</h2>

                <% if $FigureLine %>
                    <span class="mb-2 mt-6 block text-xl text-gold-light">$FigureLine</span>
                <% end_if %>

                <% if $Prose %>
                    <div class="text-base leading-7 text-white/70 [&_strong]:font-semibold [&_strong]:text-white">
                        $Prose
                    </div>
                <% end_if %>

                <% if $ButtonLink %>
                    <a class="mt-7 inline-block bg-gold px-8 py-4 text-sm font-semibold uppercase tracking-[0.15em] text-white transition-colors hover:bg-gold-dark" href="$ButtonLink" title="$ButtonText">
                        $ButtonText
                    </a>
                <% end_if %>

                <% if $FootnoteLine %>
                    <p class="mt-7 text-sm leading-6 text-white/60 [&_a]:text-white [&_a]:hover:text-gold-light">$FootnoteLine</p>
                <% end_if %>
            </div>
        </div>
    </section>
<% else %>
    <section class="fr-section fr-{$Variant.LowerCase} fr-block-$ID<% if $Ruled %> fr-ruled<% end_if %> py-[4.2rem] text-center fr-animate">
        <div class="fr-wrap">
            <% if $Eyebrow %>
                <span class="fr-label">$Eyebrow</span>
            <% end_if %>

            <h2 class="fr-h2 mx-auto mb-[1.4rem] mt-[.9rem] max-w-[24ch] text-[clamp(1.7rem,3.6vw,2.4rem)]">$Heading</h2>

            <% if $FigureLine %>
                <span class="fr-figure">$FigureLine</span>
            <% end_if %>

            <% if $Prose %>
                <div class="fr-prose mx-auto max-w-[40rem] text-[1rem]">
                    $Prose
                </div>
            <% end_if %>

            <% if $ButtonLink %>
                <a class="fr-btn fr-btn-gold mt-[1.7rem] inline-block" href="$ButtonLink" title="$ButtonText">
                    $ButtonText
                </a>
            <% end_if %>

            <% if $FootnoteLine %>
                <p class="mt-[1.7rem] text-[.9rem]">$FootnoteLine</p>
            <% end_if %>
        </div>
    </section>
<% end_if %>
