document.addEventListener("DOMContentLoaded", function () {
    const maps = document.querySelectorAll(".google-map");

    maps.forEach((el) => {
        const lat = parseFloat(el.dataset.lat);
        const lng = parseFloat(el.dataset.lng);

        if (!isNaN(lat) && !isNaN(lng)) {
            const map = new google.maps.Map(el, {
                center: { lat: lat, lng: lng },
                zoom: 14,
            });

            new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map: map,
            });
        }
    });
});
