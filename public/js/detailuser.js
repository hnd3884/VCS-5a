class DetailUser {
    constructor() {
        this.Init();
    }

    Init() {
        $(document).on('click', 'a.delete-mess', this.DeleteForward);
        $(document).on('click', 'a.edit-mess', this.ShowEditModal);
    }

    DeleteForward() {
        var userId = $(this).attr('userid');
        var messId = $(this).attr('messid');

        $('a#delete-mess-forward').attr('href', '../controllers/DeleteMessageController.php?messid=' + messId + '&userid=' + userId);
    }

    ShowEditModal(){
        var messId = $(this).attr('messid');
        var content = $('div[messid="'+messId+'"]').text();

        $('textarea[name="newmessage"]').val(content);
        $('input[name="messid"]').val(messId);
    }
}

var detailUser = new DetailUser();
