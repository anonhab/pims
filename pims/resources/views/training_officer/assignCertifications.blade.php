<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prison information management system</title>
        <link href="https://fonts.googleapis.com/icon?family=Poppins" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/font-awesome-line-awesome/css/all.min.css" integrity="sha512-dC0G5HMA6hLr/E1TM623RN6qK+sL8sz5vB+Uc68J7cBon68bMfKcvbkg6OqlfGHo1nMmcCxO5AinnRTDhWbWsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css" integrity="sha512-HqxHUkJM0SYcbvxUw5P60SzdOTy/QVwA1JJrvaXJv4q7lmbDZCmZaqz01UPOaQveoxfYRv1tHozWGPMcuTBuvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                <link rel="stylesheet" href="css/app.css">
    </head>
    <body>
        
        <!--   NAV -->
        @include('includes.nav')
        <div class="columns" id="app-content">
        @include('training_officer.menu')
    

            <div class="column is-10" id="page-content">
                    <div class="content-header">
        <h4 class="title is-4">Assign Certification/h4>        
    </div>

    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Certification Management</h1>
    
            <form>
                <div class="columns">
                    <!-- Certification Information -->
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Certification Information</p>
    
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
                                    <label class="label">Certification Name</label>
                                    <div class="control">
                                        <input class="input" type="text" placeholder="Enter certification name" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Issued By</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
                                                <option value="">Select Issuing Officer</option>
                                                <option>Officer 1</option>
                                                <option>Officer 2</option>
                                                <option>Officer 3</option>
                                                <!-- Dynamically populate this list with training officers -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>
    
                    <!-- Certification Details -->
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Certification Details</p>
    
                                <div class="field">
                                    <label class="label">Issued Date</label>
                                    <div class="control">
                                        <input class="input" type="date" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Expiration Date (if applicable)</label>
                                    <div class="control">
                                        <input class="input" type="date">
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Certification Type</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
                                                <option value="">Select Certification Type</option>
                                                <option>Work Training</option>
                                                <option>Educational</option>
                                                <option>Behavioral</option>
                                                <option>Other</option>
                                                <!-- Dynamically populate this list with certification types -->
                                            </select>
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

       @include('includes.footer_js')
    </body>

</html>
