$(document).ready(function () {

    function fetchStudent() {
        $.ajax({
            url: '/api/student',
            method: 'GET',
            success: function (data) {
                var rows = '';
                data.forEach(function (student) {
                    rows += `<tr>
                                <td class="py-2 px-2 border">${student.name}</td>
                                <td class="py-2 px-2 border">${student.email}</td>
                                <td class="py-2 px-2 border">${student.course}</td>
                                <td class="py-2 px-2 border">${student.date}</td>
                                <td class="py-2 px-2 border d-flex justify-content-center align-items-center">
                                    <!-- Here is the checkbox reflecting student.active (1 for checked, 0 for unchecked) -->
                                    <input type="checkbox" class="form-check-input" ${student.active === 1 ? 'checked' : ''} disabled>
                                </td>
                                <td class="py-2 px-2 border">
                                    <button class="btn edit-btn btn-sm" data-id="${student.id}">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${student.id}">Delete</button>
                                </td>
                             </tr>`;
                });
                $('#students tbody').html(rows);
            },
            error: function (err) {
                console.error('Error fetching students:', err);
            }
        });
    }
    

    // Initial fetch
    fetchStudent();

    $(document).on('click', '#addStudentButton', function () {
        $('#addStudentForm')[0].reset();
        $('#addStudentModal').modal('show');
    });

    $('#addStudentForm').on('submit', function (e) {
        e.preventDefault();

        var data = {
            name: $('#studentName').val(),
            email: $('#studentEmail').val(),
            course: $('#studentCourse').val(),
            date: $('#dateCreated').val(),
            address: $('#studentAddress').val(),
            active: $('#studentAgree').prop('checked') ? 1 : 0
        };
        $.ajax({
            url: '/api/student/create-student',
            method: 'POST',
            data: data,
            success: function (student) {
                console.log(student.message)
                setTimeout(function () {
                    $('#addStudentModal').modal('hide');
                    showMessageModal('Student added successfully.', 'success');
                    fetchStudent();
                }, 500);
            },
            error: function () {
                showMessageModal('Failed to add student.', 'error');
            }
        });
    });

    $(document).on('click', '.edit-btn', function () {
        var id = $(this).data('id');

        $.ajax({
            url: '/api/student/' + id,
            method: 'GET',
            success: function (student) {
                $('#editStudentId').val(student.data.id);
                $('#editStudentName').val(student.data.name);
                $('#editStudentEmail').val(student.data.email);
                $('#editStudentCourse').val(student.data.course);
                $('#editStudentModal').modal('show');
            }
        });
    });

    $('#editStudentForm').on('submit', function (e) {
        e.preventDefault();

        var id = $('#editStudentId').val();
        var data = {
            name: $('#editStudentName').val(),
            email: $('#editStudentEmail').val(),
            course: $('#editStudentCourse').val()
        };

        $.ajax({
            url: '/api/student/update-student/' + id,
            method: 'PUT',
            data: data,
            success: function () {
                setTimeout(function () {
                    $('#editStudentModal').modal('hide');
                    showMessageModal('Student updated successfully.', 'success');
                    fetchStudent();
                }, 500);
            },
            error: function () {
                showMessageModal('Failed to update student.', 'error');
            }
        });
    });

    $(document).on('click', '.delete-btn', function () {
        var id = $(this).data('id');

        $('#confirmationModal').modal('show');

        $('#confirmDelete').off('click').on('click', function () {
            $.ajax({
                url: '/api/student/delete-student/' + id,
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function () {
                    setTimeout(function () {
                        $('#confirmationModal').modal('hide');
                        showMessageModal('Student deleted successfully.', 'success');
                        fetchStudent();
                    }, 500);
                },
                error: function () {
                    showMessageModal('Failed to delete student.', 'error');
                }
            });
        });
    });

    function showMessageModal(message, type = 'success') {
        let icon, color;

        if (type === 'success') {
            icon = '<i class="bi bi-check-circle-fill text-success fs-4 me-2"></i>';
            color = 'text-success';
        } else {
            icon = '<i class="bi bi-exclamation-triangle-fill text-danger fs-4 me-2"></i>';
            color = 'text-danger';
        }

        $('#messageIconSystem').html(icon);
        $('#messageContentSystem').html(`<span class="${color}">${message}</span>`);
        $('#systemmessageModal').modal('show');
    }
});
