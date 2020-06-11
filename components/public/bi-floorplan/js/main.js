console.log("Flurplan geladen ...");

fetch('http://localhost/bi-kompass-component-service/api/floorplan/svg/nw10og2')
    .then((res) => res.json())
    .then((data) => {
        console.log(data);
    });