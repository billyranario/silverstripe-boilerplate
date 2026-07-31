<header class="border-b border-gray-border bg-white font-archivo">
    <div class="container flex flex-wrap items-center justify-between gap-4 py-6">
        <span class="text-lg font-semibold text-heading">$Wordmark</span>
        <div class="flex items-center gap-6">
            <% if $Tagline %>
                <span class="text-xs uppercase tracking-[0.2em] text-body">$Tagline</span>
            <% end_if %>
            <% if $PhoneLink %>
                <a
                    class="border border-gray-border px-4 py-2 text-sm font-semibold text-heading transition-colors hover:border-gold hover:text-gold"
                    href="$PhoneLink"
                    title="$PhoneText"
                >$PhoneText</a>
            <% end_if %>
        </div>
    </div>
</header>
