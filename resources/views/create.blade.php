@extends('components.layout')
@section('content')

<div class="container mt-5 min-vh-100">
    <h2 class="text-center">Laravel CRUD with Modals</h2>

    <button class="btn addstudent-btn mb-3" data-bs-toggle="modal" data-bs-target="#addStudentModal"> Add Student</button>

    <table class="table table-bordered" id="students">
        <thead>
            <tr>
                <!-- <th>ID</th> -->
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Date</th>
                <th>Agree to Terms</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addStudentForm">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="studentName" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="studentName" name="name" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="studentEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="studentEmail" name="email" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="studentCourse" class="form-label">Course</label>
                            <input type="text" class="form-control" id="studentCourse" name="course" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="dateCreated" class="form-label">Date</label>
                            <input type="date" class="form-control" id="dateCreated" name="date">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="studentAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="studentAddress" name="address">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="studentAgree" class="form-label">Agree to Terms</label>
                            <input type="checkbox" class="form-check-input" id="studentAgree" name="active">
                        </div>
                    </div> <!-- .row -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStudentForm">
                    <input type="hidden" id="editStudentId" name="studentId">
                    <div class="mb-3">
                        <label for="editStudentName" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="editStudentName" name="studentName">
                    </div>
                    <div class="mb-3">
                        <label for="editStudentEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editStudentEmail" name="studentEmail">
                    </div>
                    <div class="mb-3">
                        <label for="editStudentCode" class="form-label">Course</label>
                        <input type="text" class="form-control" id="editStudentCourse" name="studentCourse">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="Editsave">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title" id="confirmationModalLabel">Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div id="messageIconConfirm" class="me-2"></div>
                <div id="messageContentConfirm">Are you sure you want to delete this student?</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- System Message Modal -->
<div class="modal fade" id="systemmessageModal" tabindex="-1" aria-labelledby="systemmessageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="systemmessageModalLabel">System Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div id="messageIconSystem" class="me-2"></div>
                <div id="messageContentSystem"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>

@endsection
