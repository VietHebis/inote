<?php
// db, session, general info
require_once $_SERVER['DOCUMENT_ROOT'].'/code/inote/core/init.php';
// header
require_once $_SERVER['DOCUMENT_ROOT'].'/code/inote/includes/header.php';

// layoyt
if ($user)
{
    //check
    // Nếu thực hiện hành động
    if (isset($_GET['ac']))
    {
        // Xử lý chuỗi $ac
        $ac = addslashes(trim(htmlentities($_GET['ac'])));

        // Nếu hành động là thêm note
        if ($ac == 'create_note')
        {
            // Include template form thêm note
            require_once $_SERVER['DOCUMENT_ROOT'].'/code/inote/templates/create-note-form.php';
        }
        // Ngược lại nếu hành động là chỉnh sửa note
        else if ($ac == 'edit_note')
        {
            // Nếu có ID truyền vào
            if (isset($_GET['id']))
            {
                $get_id = addslashes(trim(htmlentities($_GET['id'])));
                if ($get_id != '')
                {
                    // Lệnh truy vấn kiểm tra sự tồn tại và quyền sở hữu note
                    $sql_check_id_exist = "SELECT id_note, user_id FROM notes WHERE user_id = '$data_user[id_user]' AND id_note = '$get_id'";

                    // Nếu có tồn tại và thuộc quyền sở hữu
                    if ($db->num_rows($sql_check_id_exist))
                    {
                        // Include template chỉnh sửa note
                        require_once $_SERVER['DOCUMENT_ROOT'].'/code/inote/templates/edit-note-form.php';
                    }
                    // Ngược lại không tồn tại và không thuộc quyền sở hữu
                    else
                    {
                        // Hiển thị thông báo lỗi
                        echo '
                        <div class="container">
                            <div class="alert alert-danger">
                                Note này không tồn tại hoặc không thuộc quyền sở hữu của bạn.
                            </div>
                        </div>
                    ';
                    }
                }
                // Ngược lại không có ID truyền vào
                else
                {
                    header('Location: index.php'); // Di chuyển về trang chủ
                }
            }
            else
            {
                header('Location: index.php'); // Di chuyển về trang chủ
            }
        }
        // Ngược lại nếu hành động là đổi mật khẩu
        else if ($ac == 'change_password')
        {
            // Include template form đổi mật khẩu
            require_once $_SERVER['DOCUMENT_ROOT'].'/code/inote/templates/change-pass-form.php';
        }
    }
// Ngược lại không thực hiện hành động
    else
    {
        // Include template danh sách ghi chú
        require_once $_SERVER['DOCUMENT_ROOT'].'/code/inote/templates/list-note.php';
    }

}
else
{
    require_once $_SERVER['DOCUMENT_ROOT'].'/code/inote/templates/signin-up-form.php';
}

//footer
require_once $_SERVER['DOCUMENT_ROOT'].'/code/inote/includes/footer.php';