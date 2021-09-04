document.addEventListener("DOMContentLoaded", function() 
{
    document.querySelectorAll("._delete-button").forEach(button =>
    {
        button.addEventListener("click", e =>
        {
            const check = (button.title.includes("propiedad"));

            if(confirm("¿Seguro que quieres eliminar " + (check ? "esta propiedad" : "este vendedor") + "? Esta acción es irreversible.")) return true; 
            else e.preventDefault();
        });
    });
});