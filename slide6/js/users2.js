$(document).ready(function () {
    addLoaiTaiKhoan();
    editLoaiTaiKhoan();
    deleteLoaiTaiKhoan();
    addUser();
});
function deleteLoaiTaiKhoan(){
    $(".deleteUserRole").click(function (e) { 
        e.preventDefault();
        var id=$(this).attr('data-id');
        Swal.fire({
            icon:'question',
            text: 'Xóa loại tài khoản?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Đúng',
            denyButtonText: `Không`,
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location.replace('userController.php?action=deleteRole&id='+id);
            } else if (result.isDenied) {
            }
          })
    });
}
// =========================================
function addLoaiTaiKhoan(){
    $("#addUserRoleBtn").click(function (e) { 
        e.preventDefault();
        $("#LoaiTaiKhoanModal").modal('show');
    });
}
// =========================================

function editLoaiTaiKhoan(){
    $(".editRoleBtn").click(function (e) { 
        e.preventDefault();
        var rolename=$(this).attr('data-value');
        var idLTK=$(this).attr('data-id');
        $("#idLTKEdit").val(idLTK);
        $("#rolenameedit").val(rolename);
        $("#LoaiTaiKhoanEditModal").modal('show');
    });
}
// =========================================
function addUser(){
    $("#addUserBtn").click(function (e) { 
        e.preventDefault();
        $("#TaiKhoanModal").modal('show');
    });
}