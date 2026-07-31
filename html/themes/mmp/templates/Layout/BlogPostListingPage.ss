<main class="inner-container grid grid-cols-1 gap-8 py-28 lg:grid-cols-2/1">
    <% if $BlogPosts %>
        <!-- Blog List -->
        <div class="space-y-12 [&>*]:border-b [&>*]:border-b-gray-border [&>*]:pb-12">
            <% loop $BlogPosts %>
                <div>
                    <div class="relative mb-8">
                        <div
                            class="absolute left-0 top-0 min-w-20 bg-navy p-3 text-center text-xs text-white md:min-w-28 md:p-5 md:text-base"
                        >
                            <div class="mb-3 border-b border-gold pb-3 md:mb-5 md:pb-5">$DateCreated</div>
                            <div>$YearCreated</div>
                        </div>
                        <img class="aspect-[3/2] w-full object-cover" src="$Image.Link" alt="$Image.Title" />
                    </div>
                    <div class="mb-3 flex gap-2 text-sm uppercase tracking-wider text-gold">
                        <a class="animated-underline after:h-[1px]" href="$Link">By $Author.Name</a>
                        <span>/</span>
                        <% loop $Categories %>
                            <a class="animated-underline after:h-[1px]" href="$Link">
                                $Name<% if not $IsLast %>, <% end_if %>
                            </a>
                        <% end_loop %>
                    </div>
                    <h2 class="mb-4 font-playfair text-4xl text-heading">
                        <a class="transition-colors hover:text-gold" href="$Link">
                            $Title
                        </a>
                    </h2>
                    <div class="mb-9 text-body">
                        $Content.Summary
                    </div>
                    <a class="btn" href="$Link">
                        <span class="relative z-10">Read More</span>
                    </a>
                </div>
            <% end_loop %>
            <% if $BlogPosts.MoreThanOnePage %>
                <div class="my-8 flex justify-center space-x-4">
                    <% if $BlogPosts.NotFirstPage %>
                        <a class="px-4 py-2 text-heading border border-heading transition-colors hover:bg-navy hover:text-white" href="$BlogPosts.PrevLink">Previous</a>
                    <% end_if %>

                    <% loop $BlogPosts.Pages %>
                        <a class="px-4 py-2 text-heading border border-heading transition-colors hover:bg-navy hover:text-white <% if $CurrentBool %>text-white bg-navy<% end_if %>" href="$Link">$PageNum</a>
                    <% end_loop %>

                    <% if $BlogPosts.NotLastPage %>
                        <a class="px-4 py-2 text-heading border border-heading transition-colors hover:bg-navy hover:text-white" href="$BlogPosts.NextLink">Next</a>
                    <% end_if %>
                </div>
            <% end_if %>
        </div>
    <% else %>
        <div class="text-center">
            <h2 class="mb-4 text-4xl font-playfair text-heading">No posts found</h2>
            <p class="text-body">Sorry, but there are no posts to display.</p>
        </div>
    <% end_if %>
	<% include BlogAside Categories=$AllCategories, LatestBlogPosts=$LatestBlogPosts, Tags=$AllTags %>
</main>
