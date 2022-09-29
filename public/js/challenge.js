class Challenge {
    constructor() {
        this.Init();
    }

    Init() {
        $(document).on('click', 'a.delete-challenge', this.DeleteAssignForward);
    }

    DeleteAssignForward() {
        var chalid = $(this).attr('chalid');

        $('a#delete-challenge-forward').attr('href', '../controllers/DeleteChallengeController.php?chalid=' + chalid);
    }
}

var challenge = new Challenge();