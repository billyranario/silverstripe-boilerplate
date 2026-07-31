<section id="$AnchorId" class="bg-meeting-paper py-[5.5rem] font-garamond">
    <div class="mx-auto max-w-[720px] px-10">
        <% if $Eyebrow %>
            <span class="text-[11px] uppercase tracking-[0.24em] text-meeting-gold">$Eyebrow</span>
        <% end_if %>
        <% if $Heading %>
            <h2 class="mt-3 text-[1.7rem] font-medium leading-[1.12] text-meeting-navy md:text-[2.5rem]">$Heading</h2>
        <% end_if %>
        <% if $IntroText %>
            <p class="mt-5 text-[17px] leading-[1.5] text-meeting-body">$IntroText</p>
        <% end_if %>

        <% if $SubmissionStatus == 'success' %>
            <div class="mt-8 border border-meeting-navy/[25%] bg-white p-8">
                <p class="text-[19px] font-medium text-meeting-navy">Thank you — your enquiry has been received.</p>
                <p class="mt-2 text-[15px] leading-[1.5] text-meeting-body">
                    We confirm consultations within one working day. If it's urgent, telephone
                    <% if $PhoneLink %><a class="underline underline-offset-4 hover:text-meeting-gold" href="$PhoneLink">$PhoneText</a><% else %>03 548 2154<% end_if %>.
                </p>
            </div>
        <% else %>
            <% if $SubmissionStatus == 'error' %>
                <p class="mt-6 border border-meeting-gold bg-white p-4 text-[15px] text-meeting-navy">
                    Please fill in your name, property address and phone number, then try again.
                </p>
            <% end_if %>

            <form class="mt-8 grid grid-cols-1 gap-5 md:grid-cols-2" action="/api/meeting/enquiry" method="post">
                <input type="hidden" name="Reference" value="VC&middot;26">
                <input type="hidden" name="Source" value="$SourceValue">

                <%-- Honeypot: visually hidden from humans via CSS (not type="hidden",
                     which some scrapers skip), off-screen and unreachable by tab. --%>
                <div class="absolute -left-[9999px] top-auto h-px w-px overflow-hidden" aria-hidden="true">
                    <label>Leave this field blank
                        <input type="text" name="Website" tabindex="-1" autocomplete="off">
                    </label>
                </div>

                <label class="md:col-span-2 block">
                    <span class="text-[13px] text-meeting-muted">Your name *</span>
                    <input class="mt-1 w-full border border-meeting-navy/[25%] bg-white px-4 py-3 text-[16px] text-meeting-navy focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-meeting-gold" type="text" name="Name" required>
                </label>

                <label class="md:col-span-2 block">
                    <span class="text-[13px] text-meeting-muted">Property address *</span>
                    <input class="mt-1 w-full border border-meeting-navy/[25%] bg-white px-4 py-3 text-[16px] text-meeting-navy focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-meeting-gold" type="text" name="PropertyAddress" required>
                </label>

                <label class="block">
                    <span class="text-[13px] text-meeting-muted">Phone *</span>
                    <input class="mt-1 w-full border border-meeting-navy/[25%] bg-white px-4 py-3 text-[16px] text-meeting-navy focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-meeting-gold" type="tel" name="Phone" required>
                </label>

                <label class="block">
                    <span class="text-[13px] text-meeting-muted">Email</span>
                    <input class="mt-1 w-full border border-meeting-navy/[25%] bg-white px-4 py-3 text-[16px] text-meeting-navy focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-meeting-gold" type="email" name="Email">
                </label>

                <label class="md:col-span-2 block">
                    <span class="text-[13px] text-meeting-muted">Preferred time to be contacted</span>
                    <input class="mt-1 w-full border border-meeting-navy/[25%] bg-white px-4 py-3 text-[16px] text-meeting-navy focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-meeting-gold" type="text" name="PreferredTime">
                </label>

                <div class="md:col-span-2 mt-2 flex flex-wrap items-center gap-x-6 gap-y-3">
                    <button class="min-h-[48px] bg-meeting-navy px-8 py-4 text-sm font-medium uppercase tracking-[0.15em] text-white transition-colors hover:bg-meeting-navy-hover" type="submit">
                        $SubmitLabel
                    </button>
                    <% if $PhoneLink %>
                        <a class="text-sm text-meeting-body underline underline-offset-4 hover:text-meeting-gold" href="$PhoneLink">$PhoneText</a>
                    <% end_if %>
                </div>
            </form>
        <% end_if %>
    </div>
</section>
