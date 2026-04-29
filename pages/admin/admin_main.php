<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="/training_system/assets/css/admin.css">
</head>
<body>

    <div id="layout"></div>

    <script>

        fetch("admin_layout.html")
            .then(res => res.text())
            .then(layout => {
                document.getElementById("layout").innerHTML = layout;

                const routes = {
                    dashboard: "admin_dashboard.php",
                    participant: "admin_participant.php",
                    view: "participant_view.php", 
                    edit: "participant_edit.php", 
                    course: "admin_course.php",
                    schedule: "admin_schedule.php",
                    view_course: "course_view.php"
                };

                function loadPage() {
                    let page = location.hash.replace("#", "") || "dashboard";
                    
                    // Extract page name and parameters
                    let params = {};
                    if (page.includes("?")) {
                        const parts = page.split("?");
                        page = parts[0];
                        // Parse query parameters
                        const queryString = parts[1];
                        queryString.split("&").forEach(param => {
                            const [key, value] = param.split("=");
                            params[key] = value;
                        });
                    }
                    
                    if (!routes[page]) page = "dashboard";
                    
                    // Build URL with parameters
                    let url = routes[page];
                    if (Object.keys(params).length > 0) {
                        url += "?" + Object.entries(params).map(([k,v]) => `${k}=${v}`).join("&");
                    }
                    
                    fetch(url)
                        .then(res => res.text())
                        .then(content => {
                            document.getElementById("page-content").innerHTML = content;
                        })
                        .catch(err => {
                            document.getElementById("page-content").innerHTML = 
                                '<div class="content"><h2>Error loading page</h2><p>' + err + '</p></div>';
                        });
                }

                // first load
                loadPage();
                
                // on sidebar click or hash change
                window.addEventListener("hashchange", loadPage);
            });
    </script>
</body>
</html>