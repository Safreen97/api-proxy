async function handleRequest(request) {
    let url = "https://ltaattendance.wuaze.com/fetch_employee_API.php"; // Replace with your API URL

    let response = await fetch(url, {
        method: request.method,
        headers: { "Content-Type": "application/json" },
        body: request.body
    });

    return new Response(await response.text(), {
        headers: { "Access-Control-Allow-Origin": "*", "Content-Type": "application/json" }
    });
}

addEventListener("fetch", event => {
    event.respondWith(handleRequest(event.request));
});
