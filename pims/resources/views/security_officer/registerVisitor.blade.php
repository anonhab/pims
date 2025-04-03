<!DOCTYPE html>
@include('includes.head')

<body>

    <!-- NAV -->
    @include('includes.nav')
    
    <div class="columns" id="app-content">
        @include('security_officer.menu')
         
        <div class="column is-10" id="page-content">
            <div class="content-header">
            </div>

            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Visitor Registration</h1>

                    <form action="{{ route('security_officer.storeVisitor') }}" method="POST">
                        @csrf
                        <input type="text" name="first_name" placeholder="First Name" required>
                        <input type="text" name="last_name" placeholder="Last Name" required>
                        <input type="text" name="phone_number" placeholder="Phone Number" required>
                        <input type="text" name="relationship" placeholder="Relationship" required>
                        <input type="text" name="address" placeholder="Address" required>
                        <input type="text" name="identification_number" placeholder="ID Number" required>
                        <input type="text" name="username" placeholder="Username" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit">Register</button>
                    </form>

                </div>
            </section>
        </div>
    </div>

    @include('includes.footer_js')

</body>

</html>
