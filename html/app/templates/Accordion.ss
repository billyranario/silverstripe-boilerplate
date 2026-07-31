<section class="inner-container py-10">
    <div class="accordion-container">
        <% loop $AccordionItems %>
            <div class="accordion-item group/accordion">
                <button
                    class="accordion-toggle w-full border border-b-0 border-body-gray bg-[#f8f8f9] p-5 text-left font-playfair text-[1.375rem] font-bold text-heading group-last/accordion:border-b group-[.active]/accordion:!border-b-0 group-[.active]/accordion:bg-navy group-[.active]/accordion:text-white"
                >
                    $Title
                </button>
                <div
                    class="grid grid-rows-[0fr] overflow-hidden border-x border-body-gray px-5 transition-all group-[.active]/accordion:grid-rows-[1fr] group-[.active]/accordion:py-5 group-last/accordion:group-[.active]/accordion:border-b"
                >
                    <div class="min-h-0">
                        <div class="rte">
                            $Content
                        </div>
                    </div>
                </div>
            </div>
        <% end_loop %>
        </div>
</section>