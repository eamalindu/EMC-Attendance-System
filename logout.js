function logout (){
    showCustomConfirm('You are about to Logout<br>Are You Sure?',function(result){
        if(result){
            window.location.href = 'logout.php'
        }

    })
}