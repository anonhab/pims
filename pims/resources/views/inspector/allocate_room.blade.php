<!DOCTYPE html>
@include('includes.head')
    <body>
  
        <!--   NAV -->
        @include('includes.nav')
        <div class="columns" id="app-content">
        @include('inspector.menu')
    

            <div class="column is-10" id="page-content">
                    <div class="content-header">
         
    </div>

    <section class="section">
        <div class="container">
            <h1 class="title has-text-centered">Room Allocation </h1>
    
            <form>
                <div class="columns">
                    <!-- Prisoner and Room Allocation Details -->
                    <div class="column is-half">
                        <div class="card">
                            <div class="card-content">
                                <p class="title is-4">Room Allocation</p>
    
                                <div class="field">
                                    <label class="label">Select Prisoner</label>
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
                                    <label class="label">Room Number</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
                                                <option value="">Select Room Number</option>
                                                <option value="101">101</option>
                                                <option value="102">102</option>
                                                <option value="103">103</option>
                                                <option value="104">104</option>
                                                <option value="105">105</option>
                                                <!-- Dynamically populate this list with available rooms from the system -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
    
                                <div class="field">
                                    <label class="label">Allocation Date</label>
                                    <div class="control">
                                        <input class="input" type="date" required>
                                    </div>
                                </div>
    
                                <div class="field">
                                    <label class="label">Allocated By</label>
                                    <div class="control">
                                        <div class="select is-fullwidth">
                                            <select required>
                                                <option value="">Select Allocating Officer</option>
                                                <option>Officer A</option>
                                                <option>Officer B</option>
                                                <option>Officer C</option>
                                                <!-- Dynamically populate this list with officers -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>
    
    
                </div>
    
                <!-- Submit and Reset Button -->
                <div class="field is-grouped is-grouped-left">
                    <div class="control">
                        <button class="button is-link">Allocate Room</button>
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
