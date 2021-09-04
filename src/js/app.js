document.addEventListener("DOMContentLoaded", function()
{
    // Mobile menu
    const mobileMenu = document.querySelector(".mobile-menu");
    mobileMenu.addEventListener("click", function()
    {
        const nav = document.querySelector(".navegacion");
        //if(nav.classList.contains("is-shown")) nav.classList.remove("is-shown");
        //else nav.classList.add("is-shown");
        nav.classList.toggle("is-shown"); // Hace lo mismo que el codigo de arriba
    })

    // Dark mode
    const darkmode = document.querySelector(".dark-mode-btn");
    darkmode.addEventListener("click", function()
    {
        //darkmode.style.filter = "invert(100%)";
        document.body.classList.toggle("dark-mode");
    })

    // Automatic dark-mode
    const dmpref = window.matchMedia("(prefers-color-scheme: dark)");
    //if(dmpref.matches) document.body.classList.add("dark-mode");
    //else document.body.classList.remove("dark-mode");

    dmpref.addEventListener("change", function()
    {
        if(dmpref.matches) document.body.classList.add("dark-mode");
        else document.body.classList.remove("dark-mode");
    })


    /* CONTACTO */
    const contacto = document.getElementById("contacto-medio");
    if(contacto)
    {
        contacto.addEventListener("change", e =>
        {
            document.querySelector(".contacto-telefono").classList.toggle("display-none");
            document.querySelector(".contacto-email").classList.toggle("display-none");
        })
    }
})


