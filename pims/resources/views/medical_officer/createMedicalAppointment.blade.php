<!DOCTYPE html>
<html>
@include('includes.head')

<body>
    
    <!--   NAV -->
    @include('includes.nav')
    <div class="columns" id="app-content">
    @include('medical_officer.menu')

        <div class="column is-10" id="page-content">
            <div class="content-header">
              
            </div>


            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Appointment Management</h1>

                  <form method="POST" action="{{ route('appointments.store') }}" class="box mb-5" id="appointmentForm">
    @csrf
    <div class="columns is-multiline">
        <div class="column is-6">
            <div class="field">
                <label class="label">Prisoner</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select name="prisoner_id" required>
                            <option value="">-- Select Prisoner --</option>
                            @foreach($prisoners as $prisoner)
                                <option value="{{ $prisoner->id }}">{{ $prisoner->first_name }} {{ $prisoner->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="column is-6">
            <div class="field">
                <label class="label">Doctor</label>
               
                    <div class="control has-icons-left">
                                                <input class="input" type="text" value="{{ session('first_name') }} {{ session('last_name') }}" disabled>
                                                <input type="hidden" name="doctor_id" value="{{ session('user_id') }}">
                                                <span class="icon is-small is-left">
                                                    <i class="fas fa-user-md"></i>
                                                </span>
                                            </div>
                    </div>
                
             
        </div>

        <div class="column is-6">
            <div class="field">
                <label class="label">Appointment Date</label>
                <div class="control">
                    <input type="datetime-local" name="appointment_date" class="input" required>
                </div>
            </div>
        </div>

        <div class="column is-6">
            <div class="field">
                <label class="label">Status</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select name="status" required>
                            <option value="scheduled">Scheduled</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="column is-6">
            <div class="field">
                <label class="label">Diagnosis</label>
                <div class="control">
                    <textarea class="textarea" name="diagnosis"></textarea>
                </div>
            </div>
        </div>

        <div class="column is-6">
            <div class="field">
                <label class="label">Treatment</label>
                <div class="control">
                    <textarea class="textarea" name="treatment"></textarea>
                </div>
            </div>
        </div>

        <div class="column is-12 has-text-right">
            <button type="submit" class="button is-primary">
                <span class="icon"><i class="fa fa-save"></i></span>
                <span>Save Appointment</span>
            </button>
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

    
        <script>
document.getElementById("appointmentForm").addEventListener("submit", function(event) {
    let form = event.target;
    let status = form.querySelector('[name="status"]').value;
    let appointmentDate = new Date(form.querySelector('[name="appointment_date"]').value);
    let now = new Date();

    // Check if appointment date is today or in the future
    if (appointmentDate < now) {
        alert("Appointment date must be today or in the future.");
        event.preventDefault(); // Prevent form submission
        return;
    }

    // Check if status is valid
    if (!['scheduled', 'completed', 'cancelled'].includes(status)) {
        alert("Status must be one of 'pending', 'completed', or 'cancelled'.");
        event.preventDefault(); // Prevent form submission
        return;
    }

    // You can add additional validation for other fields here if needed
});
</script>

</body>


</html>