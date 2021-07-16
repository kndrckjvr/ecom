<div class="row">
    <div class="col-12 col-md-6 mb-3 mr-1">
        <div class="border border-black p-2">
            <div class="d-flex flex-row w-100 mb-4">
                <h3 class="text-center w-100">Services</h3>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" href="#adminAddServiceModal">Add</button>
            </div>
            <div class="d-flex flex-column">
                @foreach ($services as $service)
                    <div class="d-flex flex-row justify-content-between mb-1">
                        <div class="d-flex flex-column">
                            <span>{{ $service->name }}</span>
                            <span class="text-secondary">{{ $service->user->name }}</span>
                        </div>
                        <div class="d-flex flex-column align-items-end w-50">
                            <span>{{ $service->location }}</span>
                            <button type="button" class="btn btn-primary w-25 editServices" data-id="{{ $service->id }}">
                                Edit
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $services->appends(['services', $services->currentPage()])->links() }}
        </div>
    </div>
    <div class="col-12 col-md-6 mb-3 mr-1">
        <div class="border border-black p-2">
            <div class="d-flex flex-row w-100 mb-4">
                <h3 class="text-center w-100">Users</h3>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" href="#adminAddUserModal">Add</button>
            </div>
            <div class="d-flex flex-column">
                @foreach ($users as $user)
                    <div class="d-flex flex-row justify-content-between mb-1">
                        <div class="d-flex flex-column">
                            <span>{{ $user->name }}</span>
                            <span class="text-secondary">{{ $user->email }}</span>
                        </div>
                        <div class="d-flex flex-column align-items-end w-50">
                            <span>{{ $user->currentUserType() }}</span>
                            <button type="button" class="btn btn-primary w-25 editUser" data-id="{{ $user->id }}">
                                Edit
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $users->appends(['users', $users->currentPage()])->links() }}
        </div>
    </div>
    <div class="col-12 mb-3 mr-1">
        <div class="border border-black p-2">
            <div class="d-flex flex-row w-100 mb-4">
                <h3 class="text-center w-100">Bookings</h3>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" href="#adminAddBookingModal">Add</button>
            </div>
            <div class="d-flex flex-column">
                @foreach ($bookings as $booking)
                    <div class="d-flex flex-row justify-content-between mb-2">
                        <div class="d-flex flex-column">
                            <div><b>Service Type:</b> {{ $booking->service->name }}</div>
                            <div><b>Service Company:</b> <span class="text-success">{{ $booking->service->user->name }}</span></div>
                            <div><b>Booking User:</b> <span class="text-primary">{{ $booking->user->name }} - {{ $booking->location }}</span></div>
                            <div><b>Date:</b> <span>{{ date('F j, Y, h:i A l', strtotime($booking->date)) }}</span></div>
                        </div>
                        <div class="d-flex flex-column align-items-end justify-content-center w-50">
                            <div>{{ $booking->status }}</div>
                            <button type="button" class="btn btn-primary w-25 editBookings" data-id="{{ $booking->id }}">
                                Edit
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $bookings->appends('bookings', $bookings->currentPage())->links() }}
        </div>
    </div>

    {{-- Admin Edit Booking Modal --}}
    <div class="portfolio-modal modal fade" id="adminEditBookingModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <h1>Edit Booking</h1>
                                <div class="w-100 d-block" id="adminEditBookingModalSpinner">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="d-none flex-column w-100" id="adminEditBookingModalBody">
                                    <h2 class="text-uppercase">Wasada</h2>
                                    <p>Service Type: <span id="service_type">Something Here</span></p>
                                    <p>Booking User: <span id="booking_user">Booker</span></p>
                                    <p>Date: <span id="date">Date</span></p>
                                    <p>Current Status: <span id="current_status">Booker</span></p>
                                    <div class="w-100">
                                        <b>Update Status: </b>
                                        <button type="button" id="updateStatus-check_avail" class="btn btn-info">Check for Availability</button>
                                        <button type="button" id="updateStatus-approve" class="btn btn-warning">Approved</button>
                                        <button type="button" id="updateStatus-paid" class="btn btn-success">Paid</button>
                                        <button type="button" id="updateStatus-done" class="btn btn-danger">Done</button>
                                        <button type="button" id="updateStatus-deny" class="btn btn-secondary">Deny</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Admin Add Booking Modal --}}
    <div class="portfolio-modal modal fade" id="adminAddBookingModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <h1>Add Booking</h1>
                                <form action="/admin/booking/add" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="service_id">Service Type</label>
                                        <select name="service_id" class="form-control">
                                            @foreach (\App\Models\Service::all() as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }} - {{ $service->user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_id">Booking</label>
                                        <select name="user_id" class="form-control">
                                            @foreach (\App\Models\User::whereIn('status', [1, 3])->get() as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="datetime-local" name="date" class="form-control">
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-success">Add Booking</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Admin Edit Booking Modal --}}
    <div class="portfolio-modal modal fade" id="adminEditServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <h1>Edit Booking</h1>
                                <div class="w-100 d-block" id="adminEditServiceModalSpinner">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="d-none flex-column w-100" id="adminEditServiceModalBody">
                                    <form action="/admin/service/update" method="post">
                                        @csrf
                                        <input type="hidden" name="id" id="idEditService">
                                        <div class="form-group">
                                            <label for="name">Service Type</label>
                                            <input type="text" name="name" id="nameEditService" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Service Location</label>
                                            <input type="text" name="location" id="locationEditService" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="descriptionEditService" class="form-control" cols="30" rows="10"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">User</label>
                                            <select name="user_id" id="user_idEditService" class="form-control">
                                                @foreach (\App\Models\User::where('status', 2)->get() as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-success">Update Service</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Admin Add User --}}
    <div class="portfolio-modal modal fade" id="adminAddUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <h1>Add User</h1>
                                <form action="/admin/user/add" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">User Type</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="0">Inactive</option>
                                            <option value="1">Booking User</option>
                                            <option value="2">Service User</option>
                                            <option value="3">Administrator</option>
                                        </select>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-success">Add User</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Admin Edit User --}}
    <div class="portfolio-modal modal fade" id="adminEditUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <h1>Update User</h1>
                                <div class="w-100 d-block" id="adminEditUserModalSpinner">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="d-none flex-column w-100" id="adminEditUserModalBody">
                                    <form action="/admin/user/update" method="post">
                                        @csrf
                                        <input type="hidden" name="id" id="idEditUser">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="nameEditUser" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="emailEditUser" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="passwordEditUser" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="status">User Type</label>
                                            <select name="status" id="statusEditUser" class="form-control">
                                                <option value="0">Inactive</option>
                                                <option value="1">Booking User</option>
                                                <option value="2">Service User</option>
                                                <option value="3">Administrator</option>
                                            </select>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-success">Update User</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Admin Add Service --}}
    <div class="portfolio-modal modal fade" id="adminAddServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <h1>Add Services</h1>
                                <form action="/admin/service/add" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Service Type</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Service Location</label>
                                        <input type="text" name="location" id="location" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">User</label>
                                        <select name="user_id" id="user_id" class="form-control">
                                            @foreach (\App\Models\User::where('status', 2)->get() as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-success">Add Service</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>