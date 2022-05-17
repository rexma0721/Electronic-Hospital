export default class ConfirmBox {
    constructor($this) {
        this.ref = $this;
    }
    removeBox(slug, text, obj) {
        let self = this.ref;
        swal({
                title: "Are you sure?",
                text: text,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    self.remove(obj);
                    swal("Deleted!", `Your ${slug} has been deleted.`, "success");
                } else {
                    swal("Cancelled", `Your ${slug} is safe :)`, "error");
                }
            });
    }
    bulkRemoveBox(slug, text) {
        let self = this.ref;
        swal({
                title: "Are you sure?",
                text: text,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete all!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    self.removeMultiple();
                    swal("Deleted!", `Your selected ${slug} has been deleted.`, "success");
                } else {
                    swal("Cancelled", `Your selected ${slug} is safe :)`, "error");
                }
            });
    }
    bulkStatusBox(slug, text) {
        let self = this.ref;
        swal({
                title: "Are you sure?",
                text: text,
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, update all!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    self.switchStatusSelected();
                    swal("Updated!", `Your selected ${slug} has been updated.`, "success");
                } else {
                    swal("Cancelled", `Your selected ${slug} are not updated :)`, "error");
                }
            });
    }
}
