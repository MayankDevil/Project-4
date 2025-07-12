/*
-   Project: ""
-   File: js/script.js
-   Description: main script
*/

$(document).ready(function () {

    console.log('script active')

    $(".alert").show()

    setTimeout(() => {
        $(".alert").fadeOut()
    }, 3000)

    
    
    
    setInterval(function () {
        
        $("#timer").text(Date().slice(0,24))


    }, 1000)
    
})

/* Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil */