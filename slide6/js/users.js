$(document).ready(function () {
    addLoaiTaiKhoan();
});
function addLoaiTaiKhoan(){
    $("#addUserRoleBtn").click(function (e) { 
        e.preventDefault();
        $("#LoaiTaiKhoanModal").modal('show');
        $("#submitLoaiTaiKhoan").click(function (e) { 
            e.preventDefault();
            var name = $("#rolename").val().trim();
            if(name==''){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })
                  
                  Toast.fire({
                    icon: 'error',
                    title: 'Thiếu loại tài khoản'
                  })
            }else{
                $.ajax({
                    type: "post",
                    url: "url",
                    data: "data",
                    dataType: "dataType",
                    success: function (response) {
                        
                    }
                });
            }
        });
    });
}