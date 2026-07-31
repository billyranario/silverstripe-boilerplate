<% with $Job %>
    <div class="bg-navy py-14">
        <div class="inner-container text-white">
            <img class="mb-9 w-full h-96 object-cover" src="$Image.Link" alt="$Image.Title" />
            <h1 class="mb-9 font-playfair text-6xl font-bold">$Title</h1>
            <div class="grid grid-cols-2 gap-5">
                <% if $EmploymentType %>
                    <div class="flex items-center gap-4">
                        <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                            ><path
                                d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"
                            />
                        </svg>
                        <span>$EmploymentType</span>
                    </div>
                <% end_if %>
                <% if $Salary %>
                    <div class="flex items-center gap-4">
                        <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"
                            ><path
                                d="M64 64C28.7 64 0 92.7 0 128V384c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H64zm64 320H64V320c35.3 0 64 28.7 64 64zM64 192V128h64c0 35.3-28.7 64-64 64zM448 384c0-35.3 28.7-64 64-64v64H448zm64-192c-35.3 0-64-28.7-64-64h64v64zM288 160a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"
                            />
                        </svg>
                        <span>$Salary</span>
                    </div>
                <% end_if %>
                <% if $Location %>
                    <div class="flex items-center gap-4">
                        <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                            ><path
                                d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm50.7-186.9L162.4 380.6c-19.4 7.5-38.5-11.6-31-31l55.5-144.3c3.3-8.5 9.9-15.1 18.4-18.4l144.3-55.5c19.4-7.5 38.5 11.6 31 31L325.1 306.7c-3.2 8.5-9.9 15.1-18.4 18.4zM288 256a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"
                            />
                        </svg>
                        <span>$Location</span>
                    </div>
                <% end_if %>
            </div>
        </div>
    </div>
    <main class="inner-container pb-24 pt-12">
        <div>
            <div class="rte">$Content</div>
        </div>
    </main>
<% end_with %>