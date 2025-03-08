<!DOCTYPE html>
<html>
@include('includes.head')

<body>
    
    <!--   NAV -->
    @include('includes.nav')
    <div class="columns" id="app-content">
    @include('lawyer.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
                
            </div>


            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Appointment Management</h1>

                    <form>
                        <div class="columns">
                            <!-- Appointment Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Appointment Information</p>

                                        <div class="field">
                                            <label class="label">Prisoner</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select required>
                                                        <option value="">Select Prisoner</option>
                                                        <option>John Doe</option>
                                                        <option>Jane Smith</option>
                                                        <option>Michael Johnson</option>
                                                        <!-- Dynamically populate this list with prisoners -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Medical Officer</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select required>
                                                        <option value="">Select Medical Officer</option>
                                                        <option>Dr. Sarah Williams</option>
                                                        <option>Dr. James Brown</option>
                                                        <option>Dr. Olivia Davis</option>
                                                        <!-- Dynamically populate this list with medical officers -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Appointment Date</label>
                                            <div class="control">
                                                <input class="input" type="date" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Appointment Details -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Appointment Details</p>

                                        <div class="field">
                                            <label class="label">Notes</label>
                                            <div class="control">
                                                <textarea class="textarea" placeholder="Enter appointment notes"
                                                    required></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Submit and Reset Button -->
                        <div class="field is-grouped is-grouped-right">
                            <div class="control">
                                <button class="button is-link">Submit</button>
                            </div>
                            <div class="control">
                                <button class="button is-light" type="reset">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>





        </div>
    </div>

    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4TVE6RNN41"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-4TVE6RNN41');
    </script>

    <script
        type=application/ld+json>{"@context":"http://schema.org","@type":"WebSite","url":"https://www.nafplann.com/","name":"Abdul Manaaf | Fullstack Web Developer","author":"Abdul Manaaf","image":"https://avatars3.githubusercontent.com/u/7114259?s=460&v=4","description":"Abdul Manaaf is a Fullstack Web Developer from Indonesia","sameAs":["https://www.facebook.com/nafplann","https://instagram.com/nafplann","https://twitter.com/nafplann","https://id.linkedin.com/in/nafplann","https://github.com/nafplann"]}</script>

    <script
        type=application/ld+json>{"@context":"http://schema.org","@type":"Person","email":"mailto:nafplann@gmail.com","image":"https://avatars3.githubusercontent.com/u/7114259?s=460&v=4","jobTitle":"Fullstack Web Developer","name":"Abdul Manaaf","url":"https://www.nafplann.com/","sameAs":["https://www.facebook.com/nafplann","https://instagram.com/nafplann","https://twitter.com/nafplann","https://id.linkedin.com/in/nafplann","https://github.com/nafplann"]}</script>

    <script type=application/ld+json>{
            "@context":"http://schema.org",
            "@type":"BreadcrumbList",
            "itemListElement":[
               {
                  "@type":"ListItem",
                  "position":1,
                  "item":{
                     "@id":"https://nafplann.com/",
                     "name":"Home",
                     "image":"https://avatars3.githubusercontent.com/u/7114259?s=460&v=4"
                  }
               },
               {
                  "@type":"ListItem",
                  "position":2,
                  "item":{
                     "@id":"https://nafplann.com/bulma-admin/",
                     "name":"free-bulma-admin-dashboard-template",
                     "image":"https://avatars3.githubusercontent.com/u/7114259?s=460&v=4"
                  }
               }
            ]
         }</script>
</body>


</html>