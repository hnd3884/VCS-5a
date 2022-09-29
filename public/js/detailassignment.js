class DetailAssignment{
    constructor(){
        this.Init();
    }

    Init(){
        $(".custom-file-input").on("change", this.ChooseFile);
    }

    ChooseFile(){
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    }
}

var detailAssignment = new DetailAssignment();