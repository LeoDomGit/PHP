$(document).ready(function () {
    addLoaiTaiKhoan();
});
function addLoaiTaiKhoan(){
    $("#addUserRoleBtn").click(function (e) { 
        e.preventDefault();
        $("#LoaiTaiKhoanModal").modal('show');
    });
}