

        setInterval(() => {
    let now = new Date();
    let datetime = now.toLocaleDateString() + " " + now.toLocaleTimeString();

    document.getElementById("timedisplay").innerHTML = datetime;
    document.getElementById("time").value = datetime;
}, 1000);