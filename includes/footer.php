<div class="modal fade" id="modalDeleteNote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-trash"></span> Xoá note</h4>
            </div>
            <div class="modal-body">
                <p>Bạn chắc chắn muốn xoá note này không ?</p>
                <div class="alert alert-danger hidden"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
                <button type="button" class="btn btn-primary" id="submit_delete_note">Đồng ý</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRemind" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-ok-circle"></span> Remind</h4>
            </div>
            <div class="modal-body">
                <p>Create Remind </p>
                <p>Vui lòng nhập ngày nhắc việc:</p>
                <div class="container">
                    <div class="row">
                        <div class='col-sm-6'>
                            <div id="datetimepicker" class="input-append date">
                                <input type="text" id="date_remind"/>
                                <span class="add-on">
                                    <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-danger hidden"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
                <button type="button" class="btn btn-primary" id="submit_remind">Đồng ý</button>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery.js"></script>
<script src="js/plugins/autogrow.js"></script>
<script src="js/functions/signup.js"></script>
<script src="js/functions/signin.js"></script>
<script src="js/functions/note.js"></script>
<script src="js/functions/change-pass.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript"
        src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
</script>
<script type="text/javascript"
        src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
</script>
<script type="text/javascript">
    $('#datetimepicker').datetimepicker({
        format: 'yyyy-MM-dd hh:mm',
        language: 'pt-BR',
        pickSeconds: false,
    });
</script>
</body>
</html>