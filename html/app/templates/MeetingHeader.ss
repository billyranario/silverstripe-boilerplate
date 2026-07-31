<header class="border-b border-meeting-navy/[14%] bg-white font-garamond">
    <div class="mx-auto flex max-w-[1180px] flex-wrap items-center justify-between gap-4 px-10 py-5">
        <a href="#" class="flex items-center gap-3">
            <% if $MarkImage %>
                <img class="h-8 w-auto" src="$MarkImage.Fill(64,64).URL" alt="">
            <% end_if %>
            <% if $WordmarkImage %>
                <img class="h-6 w-auto" src="$WordmarkImage.ScaleWidth(200).URL" alt="McFadden McMeeken Phillips Lawyers">
            <% end_if %>
        </a>

        <nav class="flex flex-wrap items-center gap-8 text-[13px] text-meeting-body">
            <% if $NavLabel1 %><a class="hidden md:inline hover:text-meeting-gold" href="$NavAnchor1">$NavLabel1</a><% end_if %>
            <% if $NavLabel2 %><a class="hidden md:inline hover:text-meeting-gold" href="$NavAnchor2">$NavLabel2</a><% end_if %>
            <% if $NavLabel3 %><a class="hidden md:inline hover:text-meeting-gold" href="$NavAnchor3">$NavLabel3</a><% end_if %>
            <% if $PhoneLink %>
                <a class="font-medium text-meeting-navy hover:text-meeting-gold" href="$PhoneLink">$PhoneText</a>
            <% end_if %>
        </nav>
    </div>
</header>
