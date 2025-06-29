/*
-   Project: ""
-   File: js/script.js
-   Description: main script
*/
$(document).ready(function () {

    console.log('script active');

    function activeSection (section) {
        
        let clicked = section.text().trim().toLowerCase()
        
        $("#post_section, #categorie_section, #user_section").hide();

        if (clicked === "post") {
            $("#post_section").show();
        } else if (clicked === "categorie") {
            $("#categorie_section").show();
        } else if (clicked === "user") {
            $("#user_section").show();
        }
    }

    /* on click button call activesection pass this */

    let navbar_button = $("#dash_navbar button")

    navbar_button.on("click", function () {

        activeSection($(this))
    })

    activeSection(navbar_button.eq(1)) // default section
    
})

/* Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil */