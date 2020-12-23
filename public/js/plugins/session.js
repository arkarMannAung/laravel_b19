$(document).ready(function(){
    $("#nav-pending-tab").click(function(){
        setSession('nav','pending','setSession.php');
    })
    $("#nav-confirm-tab").click(function(){
        setSession('nav','confirm','setSession.php');
    })
    $("#nav-delivery-tab").click(function(){
        setSession('nav','delivery','setSession.php');
    })
    $("#nav-cancel-tab").click(function(){
        setSession('nav','cancel','setSession.php');
    })
    // setSession('nav','myhome','setSession.php');
    // var get = getSession('nav','getSession.php');
    // console.log(get);
    // function getSession(key,url){
    //     var response='0';
    //     $.ajax({
    //         url:url,
    //         method:"POST",
    //         data:{key:key},
    //         success:function(data){
               
    //         }
    //     });
    //     return response;
    // }

    function setSession(key,value,url){
        $.ajax({
            url:url,
            method:"POST",
            data:{key:key,value:value},
            success:function(data){
                // console.log(data);
            }
        });
    }
    /*
    // <?php
        // this is session set function 
        // testing by arkar mann aung 12/8/2020
        // session_start();
        // $key = $_POST['key'];
        // $value = $_POST['value'];

        // $_SESSION[$key]=$value;
        // echo 'done';
    // ?>
    */
})