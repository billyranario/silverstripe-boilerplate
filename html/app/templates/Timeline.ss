<% if $MobileSpacingCSS || $TabletSpacingCSS || $DesktopSpacingCSS %>
    <style>
        .fr-block-$ID { $MobileSpacingCSS }
        @media (min-width: 768px) { .fr-block-$ID { $TabletSpacingCSS } }
        @media (min-width: 1280px) { .fr-block-$ID { $DesktopSpacingCSS } }
    </style>
<% end_if %>
<section class="fr-section fr-{$Variant.LowerCase} fr-block-$ID<% if $Ruled %> fr-ruled<% end_if %> py-[3.4rem]">
    <div class="fr-wrap">
        <div class="mx-auto mb-12 max-w-[40rem] text-center">
            <% if $Eyebrow %>
                <span class="fr-label">$Eyebrow</span>
            <% end_if %>
            <h2 class="fr-h2 mt-[.9rem] text-[clamp(1.6rem,3.4vw,2.3rem)]">$Heading</h2>
            <% if $Intro %>
                <p class="mt-4 text-[.98rem]">$Intro</p>
            <% end_if %>
        </div>

        <div class="fr-timeline fr-animate">
            <% loop $Moments.Sort('Sort') %>
                <div class="fr-moment">
                    <% if $Time %>
                        <time class="fr-moment-time">$Time</time>
                    <% end_if %>
                    <h3 class="fr-moment-title">$Title</h3>
                    <p class="text-[.93rem]">$Content</p>
                </div>
            <% end_loop %>
        </div>
    </div>
</section>
