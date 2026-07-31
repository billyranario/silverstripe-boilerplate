<% if $MobileSpacingCSS || $TabletSpacingCSS || $DesktopSpacingCSS %>
    <style>
        .fr-block-$ID { $MobileSpacingCSS }
        @media (min-width: 768px) { .fr-block-$ID { $TabletSpacingCSS } }
        @media (min-width: 1280px) { .fr-block-$ID { $DesktopSpacingCSS } }
    </style>
<% end_if %>
<section class="fr-section fr-{$Variant.LowerCase} fr-block-$ID<% if $Ruled %> fr-ruled<% end_if %> py-[5rem] text-center fr-animate">
    <div class="fr-wrap pb-[3.6rem]">
        <% if $Eyebrow %>
            <span class="fr-label">$Eyebrow</span>
        <% end_if %>

        <h1 class="fr-h1 mx-auto mb-[1.4rem] mt-[1.3rem] max-w-[17ch]">$Heading</h1>

        <% if $Lede %>
            <p class="fr-lede mx-auto max-w-[37rem] text-[1.09rem]">$Lede</p>
        <% end_if %>

        <% if $PrimaryButtonLink || $SecondaryButtonLink %>
            <div class="mt-[2.2rem] flex flex-wrap justify-center gap-4">
                <% if $PrimaryButtonLink %>
                    <a class="fr-btn fr-btn-gold" href="$PrimaryButtonLink" title="$PrimaryButtonText">
                        $PrimaryButtonText
                    </a>
                <% end_if %>
                <% if $SecondaryButtonLink %>
                    <a class="fr-btn fr-btn-line" href="$SecondaryButtonLink" title="$SecondaryButtonText">
                        $SecondaryButtonText
                    </a>
                <% end_if %>
            </div>
        <% end_if %>

        <% if $ReferenceLine %>
            <p class="mt-[1.2rem] text-[.8rem]">$ReferenceLine</p>
        <% end_if %>
    </div>
</section>
