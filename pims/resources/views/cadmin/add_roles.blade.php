<!DOCTYPE html>
@include('includes.head')

<body>
    @include('includes.nav')
    
    <div class="columns" id="app-content">
        @include('cadmin.menu')
      
        <div class="column is-10" id="page-content">
            <div class="content-header"></div>
            
           

            <section class="section">
                <div class="container">
                    <h1 class="title has-text-centered">Role Management</h1>
                    
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        
                        <div class="columns is-centered">
                            <div class="column is-half">
                                <div class="card room-card has-shadow-hover">
                                    <div class="card-content">
                                        <p class="title is-4">Add Role</p>

                                        <div class="field">
                                            <label class="label">Role Name</label>
                                            <div class="control">
                                                <div class="select is-fullwidth">
                                                    <select name="name" required>
                                                        <option value="">Select Role</option>
                                                        <option value="Central Administrator">Central Administrator</option>
                                                        <option value="System Administrator">System Administrator</option>
                                                        <option value="Inspector">Inspector</option>
                                                        <option value="Commissioner">Commissioner</option>
                                                        <option value="Police Officer">Police Officer</option>
                                                        <option value="Lawyer">Lawyer</option>
                                                        <option value="Security Officer">Security Officer</option>
                                                        <option value="Medical Officer">Medical Officer</option>
                                                        <option value="Training Officer">Training Officer</option>
                                                        <option value="Visitor">Visitor</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field">
                                            <label class="label">Description</label>
                                            <div class="control">
                                                <input class="input" type="text" name="description" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="field is-grouped is-grouped-centered">
                            <div class="control">
                                <button class="button is-link" type="submit">Add Role</button>
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