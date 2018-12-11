<?php
//hpc

$output=[];
$returnVal=0;
$command = "..\\..\\exec\\facialRecog\\regFace.exe ..\\..\\exec\\facialRecog\\sample_multiFace.bmp";
$result=exec($command,$output,$returnVal);  //单纯检测画面中有几个人脸，多余1个时 output 或者 result为2
                                            //无，0;
                                            //恰好1个时为1
$command2 = "..\\..\\exec\\facialRecog\\facialRecog.exe ..\\..\\exec\\facialRecog\\sample_o.bmp ..\\..\\exec\\facialRecog\\sample_l.bmp";
$output2=[];
$returnVal2=0;
$result2=exec($command2,$output2,$returnVal2);
echo 0;
?>

<!-- base64->img file  [write in JS]
function base64ToBlob(urlData) {
        var arr = urlData.split(',');
        var mime = arr[0].match(/:(.*?);/)[1] || 'image/png';
        // 去掉url的头，并转化为byte
        var bytes = window.atob(arr[1]);
        // 处理异常,将ascii码小于0的转换为大于0
        var ab = new ArrayBuffer(bytes.length);
        // 生成视图（直接针对内存）：8位无符号整数，长度1个字节
        var ia = new Uint8Array(ab);
        
        for (var i = 0; i < bytes.length; i++) {
            ia[i] = bytes.charCodeAt(i);
        }

        return new Blob([ab], {
            type: mime
        });
    } -->