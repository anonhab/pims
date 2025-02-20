<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Prison information management system</title>
    <link href="https://fonts.googleapis.com/icon?family=Poppins" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/font-awesome-line-awesome/css/all.min.css"
        integrity="sha512-dC0G5HMA6hLr/E1TM623RN6qK+sL8sz5vB+Uc68J7cBon68bMfKcvbkg6OqlfGHo1nMmcCxO5AinnRTDhWbWsA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css"
        integrity="sha512-HqxHUkJM0SYcbvxUw5P60SzdOTy/QVwA1JJrvaXJv4q7lmbDZCmZaqz01UPOaQveoxfYRv1tHozWGPMcuTBuvQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/app.css">
    <style></style>
</head>

<body>
    

    <!--   NAV --> @include('includes.nav')
    <div class="columns" id="app-content">
        @include('includes.menu')


        <div class="column is-10" id="page-content">
            <div class="content-header">
                <h4 class="title is-4">Create Account</h4>
            </div>


            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Account Management</h1>

                    <form>
                        <div class="columns">
                            <!-- Account Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Account Information</p>

                                        <div class="field">
                                            <label class="label">Username</label>
                                            <div class="control">
                                                <input class="input" type="text" placeholder="Enter username" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Password</label>
                                            <div class="control">
                                                <input class="input" type="password" placeholder="Enter password"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Role</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select required>
                                                        <option value="Central_Admin">Central Admin</option>
                                                        <option value="Inspector">Inspector</option>
                                                        <option value="System_Admin">System Admin</option>
                                                        <option value="Training_Officer">Training Officer</option>
                                                        <option value="Medical_Officer">Medical Officer</option>
                                                        <!-- Add other roles here -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Personal Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Personal Information</p>

                                        <div class="field">
                                            <label class="label">First Name</label>
                                            <div class="control">
                                                <input class="input" type="text" placeholder="Enter first name"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Last Name</label>
                                            <div class="control">
                                                <input class="input" type="text" placeholder="Enter last name" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Email</label>
                                            <div class="control">
                                                <input class="input" type="email" placeholder="Enter email address"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Phone Number</label>
                                            <div class="control">
                                                <input class="input" type="tel" placeholder="Enter phone number">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Date of Birth</label>
                                            <div class="control">
                                                <input class="input" type="date" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Gender</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select required>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Address</label>
                                            <div class="control">
                                                <textarea class="textarea" placeholder="Enter address"
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

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-4TVE6RNN41');
    </script>

    <script
        type=application/ld+json>
        {
            "@context": "http://schema.org",
            "@type": "WebSite",
            "url": "https://www.nafplann.com/",
            "name": "Abdul Manaaf | Fullstack Web Developer",
            "author": "Abdul Manaaf",
            "image": "https://avatars3.githubusercontent.com/u/7114259?s=460&v=4",
            "description": "Abdul Manaaf is a Fullstack Web Developer from Indonesia",
            "sameAs": ["https://www.facebook.com/nafplann", "https://instagram.com/nafplann", "https://twitter.com/nafplann", "https://id.linkedin.com/in/nafplann", "https://github.com/nafplann"]
        }
    </script>



</body>


</html>