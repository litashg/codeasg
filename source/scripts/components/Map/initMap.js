const initMap = (canvas, position) =>  {

  const markerImage = {
    url: '/media/icons/map-pin.png',
    size: new google.maps.Size(29, 48)
  };

  const options = {
    zoom: 14,
    center: position,
    mapTypeId: 'roadmap',
    disableDefaultUI: true,
  };

  const map = new google.maps.Map(canvas, options);

  const marker = new google.maps.Marker({
    position: position,
    map: map
    // icon: markerImage,
  });
};

export { initMap };
