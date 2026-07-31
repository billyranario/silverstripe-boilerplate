<% if $MobileSpacingCSS || $TabletSpacingCSS || $DesktopSpacingCSS %>
    <style>
        .fr-block-$ID { $MobileSpacingCSS }
        @media (min-width: 768px) { .fr-block-$ID { $TabletSpacingCSS } }
        @media (min-width: 1280px) { .fr-block-$ID { $DesktopSpacingCSS } }
    </style>
<% end_if %>
<section class="fr-section fr-{$Variant.LowerCase} fr-block-$ID<% if $Ruled %> fr-ruled<% end_if %> py-[4.2rem]">
    <div class="fr-wrap grid grid-cols-1 gap-[2.4rem] md:grid-cols-[1.1fr_.9fr] md:gap-[3.4rem]">
        <div>
            <% if $LeftEyebrow %>
                <span class="fr-label">$LeftEyebrow</span>
            <% end_if %>
            <% if $LeftHeading %>
                <h2 class="fr-h2 my-[.9rem] text-[1.6rem]">$LeftHeading</h2>
            <% end_if %>
            <div class="fr-prose text-[.99rem]">
                $LeftContent
            </div>
        </div>

        <div<% if $RightIsPanel %> class="fr-panel"<% end_if %>>
            <% if $RightEyebrow %>
                <span class="fr-label">$RightEyebrow</span>
            <% end_if %>
            <% if $RightHeading %>
                <h2 class="fr-h2 my-[.9rem] text-[1.6rem]">$RightHeading</h2>
            <% end_if %>
            <div class="fr-prose text-[.9rem]">
                $RightContent
            </div>
        </div>
    </div>
</section>
