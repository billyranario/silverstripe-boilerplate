<% if $MobileSpacingCSS || $TabletSpacingCSS || $DesktopSpacingCSS %>
    <style>
        .fr-block-$ID { $MobileSpacingCSS }
        @media (min-width: 768px) { .fr-block-$ID { $TabletSpacingCSS } }
        @media (min-width: 1280px) { .fr-block-$ID { $DesktopSpacingCSS } }
    </style>
<% end_if %>
<section class="fr-section fr-{$Variant.LowerCase} fr-block-$ID<% if $Ruled %> fr-ruled<% end_if %> py-[4.2rem]">
    <div class="fr-wrap">
        <div class="max-w-[44rem]">
            <% if $Eyebrow %>
                <span class="fr-label">$Eyebrow</span>
            <% end_if %>
            <h2 class="fr-h2 mt-[.9rem] text-[clamp(1.7rem,3.4vw,2.3rem)]">$Heading</h2>
        </div>

        <div class="mt-[2.6rem] grid grid-cols-1 gap-[1.4rem] md:grid-cols-2">
            <% loop $Cards.Sort('Sort') %>
                <div class="fr-card">
                    <h3 class="fr-card-title">
                        <span class="fr-numeral">$Numeral</span>$Title
                    </h3>
                    <p class="text-[.93rem]">$Content</p>
                </div>
            <% end_loop %>
        </div>
    </div>
</section>
