class Home {
    constructor() {
        this.Init();
    }

    Init() {
        $(document).on('click', 'a.delete-user', this.DeleteForward);
        $(document).on('click', 'a.delete-assignment', this.DeleteAssignForward);
        $(document).on('click', 'a.edit-user', this.ShowEditBox);
    }

    DeleteForward() {
        var userId = $(this).attr('userid');
        var fullName = $(this).attr('fullname');

        $('#delete-modal-fullname').html(fullName);
        $('a#delete-user-forward').attr('href', '../controllers/DeleteController.php?userid=' + userId);
    }

    DeleteAssignForward() {
        var assignID = $(this).attr('assignid');

        $('a#delete-assignment-forward').attr('href', '../controllers/DeleteAssignmentController.php?assignid=' + assignID);
    }

    ShowEditBox(){
        var userid=$(this).attr('userid');
        var username=$('tr[userid="'+userid+'"] td[field="username"]').html();
        var fullname=$('tr[userid="'+userid+'"] td[field="fullname"]').html();
        var phonenumber=$('tr[userid="'+userid+'"] td[field="phonenumber"]').html();
        var email=$('tr[userid="'+userid+'"] td[field="email"]').html();
        var role=$('tr[userid="'+userid+'"] td[field="role"]').html() == "Student" ? false : true;

        $('#edit-fullname').val(fullname);
        $('#edit-userid').val(userid);
        $('#edit-username').val(username);
        $('#edit-phonenumber').val(phonenumber);
        $('#edit-email').val(email);
        if(role){
            $('#edit-isteacher').prop('checked',true);
        }
        else{
            $('#edit-isteacher').prop('checked',false);
        }
    }
}

var home = new Home();