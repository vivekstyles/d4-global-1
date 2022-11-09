@include('header')
<section class="m-4">
    <div class="container">
        <h2 class="text-danger" id="user_name">{{$user_name}} <span class="badge bg-secondary" id="super_user">{{$super_user? 'super': 'agent'}}</span></h2>
        <div class="row">
            <div class="col-4 align-items-end">
                <div class="input-group mb-3">
                    <input type="text" id="serach_input" class="form-control" placeholder="type..." aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary" type="button" onclick="handleSearch()" id="button-addon2">search</button>
                </div>
            </div>
            <div class="col-8">
                @if($super_user)
                <button class="btn btn-success" type="button" onclick="handleNewUser()">Add Employee</button>
                @endif
                <button class="btn btn-success" type="button" onclick="">Excel download</button>
            </div>
        </div>
        <div class="row border-dark">
            <div class="col-xs-1-12">
                <table class="table table-striped table-bordered">
                    <thead class="border-dark">
                        <tr class="border-dark">
                            <th>Emp ID</th>
                            <th>Emp Name</th>
                            <th>Role</th>
                            <th>Department</th>
                            <th>Created_at</th>
                            <th>Update_at</th>
                            @if ($super_user)
                            <th>update emp</th>
                            <th>delete emp</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="mytablebody">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-1-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" onclick="handelpagination(this)" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" onclick="handelpagination(this)" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" onclick="handelpagination(this)" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/auth/employee_report.js') }}"></script>
</main>

<div class="modal fade" id="myModal" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" onclick="handleModelClose()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="emp-name" class="col-form-label">Employee Name:</label>
                        <input type="text" name="emp_name" class="form-control" id="emp-name">
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-form-label">Role:</label>
                        <input type="text" name="role" class="form-control" id="role">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Department:</label>
                        <select name="department" id="department" class="btn btn-primary">
                            <option value="HR">HR</option>
                            <option value="Software">Software</option>
                            <option value="IT">IT</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="handleModelClose()" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="handleinsert()">Add new user</button>
            </div>
        </div>
    </div>
</div>
</body>

</html>