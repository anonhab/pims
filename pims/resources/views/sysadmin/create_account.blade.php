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
        @include('sysadmin.menu')


        <div class="column is-10" id="page-content">



            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Account Management</h1>
                    <div class="field has-addons">
                        <p class="control">
                            <a class="button" href="{{ route('saccount.show_all') }}">
                                <span class="icon is-small">
                                    <i class="fa fa-eye"></i>
                                </span>
                                <span>View Records</span>
                            </a>
                        </p>

                    </div>
                    <form action="{{ route('accounts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="columns">
                            <!-- Account Information -->
                            <div class="column is-half">
                                <div class="card">
                                    <div class="card-content">
                                        <p class="title is-4">Account Information</p>

                                        <div class="field">
                                            <label class="label">Username</label>
                                            <div class="control">
                                                <input class="input" type="text" name="username" placeholder="Enter username" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Password</label>
                                            <div class="control">
                                                <input class="input" type="password" name="password" placeholder="Enter password" required>
                                            </div>
                                        </div>

                                        <input type="hidden" name="prison_id" value="{{ session('prison_id') }}">

                                        <div class="field">
                                            <label class="label">Role</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="role_id" required>
                                                        <option value="" disabled selected>Select a role</option>
                                                        @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
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
                                                <input class="input" type="text" name="first_name" placeholder="Enter first name" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Last Name</label>
                                            <div class="control">
                                                <input class="input" type="text" name="last_name" placeholder="Enter last name" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Email</label>
                                            <div class="control">
                                                <input class="input" type="email" name="email" placeholder="Enter email address" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Phone Number</label>
                                            <div class="control">
                                                <input class="input" type="tel" name="phone_number" placeholder="Enter phone number">
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Date of Birth</label>
                                            <div class="control">
                                                <input class="input" type="date" name="dob" required>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Gender</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="gender" required>
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
                                                <textarea class="textarea" name="address" placeholder="Enter address" required></textarea>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-content">
                                                <p class="title is-4">User Image</p>
                                                <div class="field">
                                                    <div class="file has-name is-fullwidth">
                                                        <label class="file-label">
                                                            <input class="file-input" type="file" name="user_image" required>
                                                            <span class="file-cta">
                                                                <span class="file-icon">
                                                                    <i class="fa fa-upload"></i>
                                                                </span>
                                                                <span class="file-label">
                                                                    Upload Image…
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Submit and Reset Button -->
                        <div class="field is-grouped is-grouped-right">
                            <div class="control">
                                <button class="button is-link" type="submit">Submit</button>
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