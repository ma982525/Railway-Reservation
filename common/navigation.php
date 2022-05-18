<?php 

echo "<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
<div class=\"container-fluid\">
    <a class=\"navbar-brand\" href=\"#\">R.R</a>
    <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
        <ul class=\"navbar-nav mx-auto mb-2 mb-lg-0\">
            <li class=\"nav-item\">
                <a class=\"nav-link active\" aria-current=\"page\" href=\"index.php \">Home</a>
            </li>
            <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"bookingHistory.php\">Bookings</a>
            </li>
        </ul>
        <div class=\"d-flex\">
            <button class=\"btn btn-danger me-1\" type=\"submit\"><a href=\"logout.php\" class=\"text-white\" style=\"text-decoration:none\">Logout</a></button>
        </div>
    </div>
</div>
</nav>";

?>