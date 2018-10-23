document.write("<script language=javascript src='../resource/jquery/jquery.js'></script>");
document.write("<script language=javascript src='../resource/jquery/jquery.cookie.js'></script>");
document.write("<script language=javascript src='../resource/swal2/sweetalert2.all.js'></script>");
function checkState(uuid,group){
    $.post("../../php/checkState.php", {
        uuid: uuid,
        group: group,
    }).done((data) => {
        //name
        //code:表里有这个token，1；没有0
        if (data.code == 0) {
            let timerInterval
            swal({
                title: '请登录',
                html: '页面将于 <strong></strong> 秒后跳转至登陆页面.',
                timer: 7000,
                onOpen: () => {
                    swal.showLoading()
                    timerInterval = setInterval(() => {
                        swal.getContent().querySelector('strong')
                            .textContent = parseInt((swal.getTimerLeft()) / 1000)
                    }, 1000)
                },
                onClose: () => {
                    clearInterval(timerInterval)
                }
            }).then(() => {
                window.location.href="../login/login.html";
            })
        }
        else{
            return 1;
        }


        

    });
}