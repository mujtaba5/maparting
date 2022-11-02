class Dimension {
    target = new Target();
}
class Target {
    value;
}

var tempblob;
mapboxgl.accessToken = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
var Token = 'pk.eyJ1IjoibXViYXNoaXJnaXMiLCJhIjoiY2tpZWNpbTU3MXJwczJ5bnh4MDI1ZW9mNyJ9.iBdeAqhocxhiDp1ClwUzhw';
var mapTilerAccessToken = 'GMfNDVh2V7amAI8sEfUx';
console.log(base_url);
var form = document.getElementById('config');

// ERRORS
var errors = {
    width: {
        state: false,
        msg: 'Width must be a positive number!',
        grp: 'widthGroup'
    },
    height: {
        state: false,
        grp: 'heightGroup'
    },
    dpi: {
        state: false,
        msg: 'DPI must be a positive number!',
        grp: 'dpiGroup'
    }
};


try {

    if (!mapboxgl.accessToken || mapboxgl.accessToken.length < 10) {
        // Don't use Mapbox style without access token
        for (var i = form.styleSelect.length - 1; i >= 0; i--) {
            if (form.styleSelect[i].value.indexOf('mapbox') >= 0) {
                form.styleSelect.remove(i);
            }
        }
    }
    if (!mapTilerAccessToken || mapTilerAccessToken.length < 10) {
        // Don't use MapTiler styles without access token
        for (var i = form.styleSelect.length - 1; i >= 0; i--) {
            if (form.styleSelect[i].value.indexOf('tilehosting') >= 0) {
                form.styleSelect.remove(i);
            }
        }
    }

    // Show attribution requirement of initial style
    if (form.styleSelect.value.indexOf('mapbox') >= 0) {
        document.getElementById('mapbox-attribution').style.display = 'block';
    } else {
        document.getElementById('openmaptiles-attribution').style.display = 'block';
    }

    ////////
    function changeStyle(_style) {
        form.styleSelect.value = _style;
        changeMapStyle();
    }

    function changeDimension(_height, _width) {
        //document.getElementById('heightInput').value = _height;
        //document.getElementById('widthInput').value = _width;

        var dimension = new Dimension();
        var targetValue = new Target();
        targetValue.value = _width;
        dimension.target = targetValue;
        changeWidth(dimension);

        targetValue.value = _height;
        dimension.target = targetValue;
        changeHeight(dimension);

        // dimension.target.value = _width;
        // changeWidth(dimension);
    }

    function textchanged() {
        var headerText = document.getElementById('headerInput').value;

        document.getElementById('frameText').innerHTML = headerText;
    }

    function textchanged2() {
        var headerText = document.getElementById('headerInput2').value;

        document.getElementById('frameText2').innerHTML = headerText;
    }

    function classToAdd(value) {
        document.getElementById('mainFrame').className = value;
    }

    //
    // Interactive map
    //

    function updateLocationInputs() {
        var center = map.getCenter().toArray();

        var zoom = parseFloat(map.getZoom()).toFixed(2),
            lat = parseFloat(center[1]).toFixed(4),
            lon = parseFloat(center[0]).toFixed(4);
        form.zoomInput.value = zoom;
        form.latInput.value = lat;
        form.lonInput.value = lon;
    }

    var style = form.styleSelect.value;
    if (style.indexOf('maptiler') >= 0)
        style += '?key=' + mapTilerAccessToken;
    console.log(style);
    console.log('mapbox://styles/mapbox/streets-v11');
    const map = new mapboxgl.Map({
        container: 'map',
        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
        style: "mapbox://styles/mapbox/streets-v11",
        // style: style,
        center: [-122.486052, 37.830348],
        zoom: 12
    });

    map.on('style.load', function() {
        map.on('click', function(e) {
            var coordinates = e.lngLat;
            new mapboxgl.Popup()
                .setLngLat(coordinates)
                .setHTML('you clicked here: <br/>' + coordinates)
                .addTo(map);
        });
    });

    // for search on map
    map.addControl(
        new MapboxGeocoder({
            accessToken: Token,
            mapboxgl: mapboxgl
        }));

    // for navigation on map
    map.addControl(new mapboxgl.NavigationControl());

    // for zoom in to location
    map.on('moveend', updateLocationInputs).on('zoomend', updateLocationInputs);
    updateLocationInputs();

    // for loading map with coordinates
    map.on('load', () => {
        map.addSource('route', {
            'type': 'geojson',
            'data': {
                'type': 'Feature',
                'properties': {},
                'geometry': {
                    'type': 'LineString',
                    'coordinates': [
                        [-122.483696, 37.833818],
                        [-122.483482, 37.833174],
                        [-122.483396, 37.8327],
                        [-122.483568, 37.832056],
                        [-122.48404, 37.831141],
                        [-122.48404, 37.830497],
                        [-122.483482, 37.82992],
                        [-122.483568, 37.829548],
                        [-122.48507, 37.829446],
                        [-122.4861, 37.828802],
                        [-122.486958, 37.82931],
                        [-122.487001, 37.830802],
                        [-122.487516, 37.831683],
                        [-122.488031, 37.832158],
                        [-122.488889, 37.832971],
                        [-122.489876, 37.832632],
                        [-122.490434, 37.832937],
                        [-122.49125, 37.832429],
                        [-122.491636, 37.832564],
                        [-122.492237, 37.833378],
                        [-122.493782, 37.833683]
                    ]
                }
            }
        });
        map.addLayer({
            'id': 'route-layer',
            'type': 'line',
            'source': 'route',
            'layout': {
                'line-join': 'round',
                'line-cap': 'round'
            },
            'paint': {
                'line-color': '#000',
                'line-width': 8
            }
        });


        console.log(map);
        console.log(map.getSource('route')._options.data);


    });



    //
    // Geolocation
    //

    if ('geolocation' in navigator) {
        //  ----------------navigate to your current location ---------------
        // navigator.geolocation.getCurrentPosition(function(position) {
        //     'use strict';
        //     map.flyTo({
        //         center: [position.coords.longitude,
        //             position.coords.latitude
        //         ],
        //         zoom: 10
        //     });
        // });
    }


    $(document).ready(function(e) {
        console.log(map);

        $(".uploadGpx").on('click', (function(e) {
            e.preventDefault();
            console.log('here');

            console.log(map);

            form = $(this).closest('form')[0];
            var formData = new FormData(form);

            if (document.getElementById("gpxFile").files.length == 0) {
                swal("Error!", 'Please select file!', "error");
            } else {
                $.ajax({
                    url: "<?php echo base_url(); ?>upload-Gpx-File/",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    data: formData,
                    // dataType: 'json',
                    beforeSend: function() {
                        //$("#preview").fadeOut();
                        // $("#err").fadeOut();
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.coordinates) {
                            console.log('exst');
                            //                       map.setView([34.89, -87.31], 6);
                            // return true;
                            console.log(data.coordinates);
                            allcoordinates = data.coordinates;
                            console.log(allcoordinates[0]);
                            //                   map = new mapboxgl.Map({
                            //     container: 'map',
                            //     // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
                            //     style: 'mapbox://styles/mapbox/streets-v11',
                            //     center: allcoordinates[0],
                            //     zoom: 1
                            // });
                            console.log(map);
                            var feature = map.getSource('route')._options.data;
                            console.log(feature);


                            const features = map.querySourceFeatures('route', {
                                sourceLayer: 'route-layer'
                            });
                            console.log(features);
                            mapboxgl.accessToken = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
                            updateRoute(allcoordinates);

                            // map.getSource('route');
                            // map.getSource('route').setData(data.coordinates);
                            // return true;
                            // append coordinates on map
                            // map.on('result', () => {
                            // map.addSource('route', {
                            // 'type': 'geojson',
                            // 'data': {
                            // 'type': 'Feature',
                            // 'properties': {},
                            // 'geometry': {
                            // 'type': 'LineString',
                            //   'coordinates':allcoordinates,
                            // 'coordinates': [
                            // [-122.483696, 37.833818],
                            // [-122.483482, 37.833174],
                            // [-122.483396, 37.8327],
                            // [-122.483568, 37.832056],
                            // [-122.48404, 37.831141],
                            // [-122.48404, 37.830497],
                            // [-122.483482, 37.82992],
                            // [-122.483568, 37.829548],
                            // [-122.48507, 37.829446],
                            // [-122.4861, 37.828802],
                            // [-122.486958, 37.82931],
                            // [-122.487001, 37.830802],
                            // [-122.487516, 37.831683],
                            // [-122.488031, 37.832158],
                            // [-122.488889, 37.832971],
                            // [-122.489876, 37.832632],
                            // [-122.490434, 37.832937],
                            // [-122.49125, 37.832429],
                            // [-122.491636, 37.832564],
                            // [-122.492237, 37.833378],
                            // [-122.493782, 37.833683]
                            // ]
                            // }
                            // }
                            // });
                            // map.addLayer({
                            //             'id': 'route',
                            //             'type': 'line',
                            //             'source': 'route',
                            //             'layout': {
                            //                 'line-join': 'round',
                            //                 'line-cap': 'round'
                            //             },
                            //             'paint': {
                            //                 'line-color': '#000',
                            //                 'line-width': 8
                            //             }
                            //         });
                            // });
                        } else {
                            // does not exist any coordinates
                            swal("Error!", 'Data doesnt exist!', "error");
                        }
                    },
                    error: function(e) {

                    }
                });
            }
        }));

        function updateRoute(routeJSON, updateLayers = true) {

            // if (map.getSource('route')) {
            // update source data
            geoJSONData = {
                'type': 'Feature',
                'properties': {},
                'geometry': {
                    'type': 'LineString',
                    'coordinates': routeJSON

                }
            }
            map.getSource("route").setData({
                type: 'geojson',
                features: geoJSONData
            });

            // map.getSource("route").setData(geoJSONData);
            // } else {
            // create a new source
            // map.addSource("route", {
            //   "type":"geojson",
            //   "data": geoJSONData
            // });
            // }

            if (map.getLayer('route-layer') || updateLayers) {
                // remove the previous version of layer
                if (map.getLayer('route-layer')) {
                    map.removeLayer('route-layer');
                }

                map.addLayer({
                    'id': 'route-layer',
                    'type': 'line',
                    'source': 'route',
                    'layout': {
                        'line-join': 'round',
                        'line-cap': 'round'
                    },
                    'paint': {
                        'line-color': '#000',
                        'line-width': 8
                    }
                });
            }
        }

    });

    //
    // Errors
    //

    var maxSize;
    if (map) {
        var canvas = map.getCanvas();
        var gl = canvas.getContext('experimental-webgl');
        maxSize = gl.getParameter(gl.MAX_RENDERBUFFER_SIZE);
    }


    function handleErrors() {
        'use strict';
        var errorMsgElem = document.getElementById('error-message');
        var anError = false;
        var errorMsg;
        for (var e in errors) {
            e = errors[e];
            if (e.state) {
                if (anError) {
                    errorMsg += ' ' + e.msg;
                } else {
                    errorMsg = e.msg;
                    anError = true;
                }
                document.getElementById(e.grp).classList.add('has-error');
            } else {
                document.getElementById(e.grp).classList.remove('has-error');
            }
        }
        if (anError) {
            //errorMsgElem.innerHTML = errorMsg;
            //errorMsgElem.style.display = 'block';
        } else {
            //errorMsgElem.style.display = 'none';
        }
    }

    function isError() {
        'use strict';
        for (var e in errors) {
            if (errors[e].state) {
                return true;
            }
        }
        return false;
    }


    //
    // Configuration changes / validation
    //

    form.widthInput.addEventListener('change', changeWidth);

    function changeWidth(e) {
        'use strict';
        var unit = form.unitOptions[0].checked ? 'in' : 'mm';
        var val = (unit == 'mm') ? Number(e.target.value / 25.4) : Number(e.target.value);
        var dpi = Number(form.dpiInput.value);
        if (val > 0) {
            if (val * dpi > maxSize) {
                errors.width.state = true;
                errors.width.msg = 'The maximum image dimension is ' + maxSize +
                    'px, but the width entered is ' + (val * dpi) + 'px.';
            } else if (val * window.devicePixelRatio * 96 > maxSize) {
                errors.width.state = true;
                errors.width.msg = 'The width is unreasonably big!';
            } else {
                errors.width.state = false;
                if (unit == 'mm') val *= 25.4;
                form.widthInput.value = val;
                document.getElementById('map').style.width = toPixels(val);
                map.resize();
            }
        } else {
            errors.width.state = true;
            errors.height.msg = 'Width must be a positive number!';
        }
        handleErrors();
    }

    form.heightInput.addEventListener('change', changeHeight);

    function changeHeight(e) {
        'use strict';
        var unit = form.unitOptions[0].checked ? 'in' : 'mm';
        var val = (unit == 'mm') ? Number(e.target.value / 25.4) : Number(e.target.value);
        var dpi = Number(form.dpiInput.value);
        if (val > 0) {
            if (val * dpi > maxSize) {
                errors.height.state = true;
                errors.height.msg = 'The maximum image dimension is ' + maxSize +
                    'px, but the height entered is ' + (val * dpi) + 'px.';
            } else if (val * window.devicePixelRatio * 96 > maxSize) {
                errors.height.state = true;
                errors.height.msg = 'The height is unreasonably big!';
            } else {
                errors.height.state = false;
                if (unit == 'mm') val *= 25.4;
                form.heightInput.value = val;
                document.getElementById('map').style.height = toPixels(val);
                map.resize();
            }
        } else {
            errors.height.state = true;
            errors.height.msg = 'Height must be a positive number!';
        }
        handleErrors();
    }

    form.dpiInput.addEventListener('change', function(e) {
        'use strict';
        var val = Number(e.target.value);
        if (val > 0) {
            errors.dpi.state = false;
            var event = document.createEvent('HTMLEvents');
            event.initEvent('change', true, true);
            form.widthInput.dispatchEvent(event);
            form.heightInput.dispatchEvent(event);
        } else {
            errors.dpi.state = true;
        }
        handleErrors();
    });

    form.styleSelect.addEventListener('change', changeMapStyle);

    function changeMapStyle() {
        'use strict';
        try {
            var style = form.styleSelect.value;
            if (style.indexOf('maptiler') >= 0)
                style += '?key=' + mapTilerAccessToken;
            console.log(style);
            style = "mapbox://styles/mapbox/streets-v11";
            map.setStyle(style);
        } catch (e) {
            openErrorModal("Error changing style: " + e.message);
        }
        // Update attribution requirements
        if (form.styleSelect.value.indexOf('mapbox') >= 0) {
            document.getElementById('mapbox-attribution').style.display = 'block';
            document.getElementById('openmaptiles-attribution').style.display = 'none';
        } else {
            //document.getElementById('mapbox-attribution').style.display = 'none';
            document.getElementById('openmaptiles-attribution').style.display = 'block';
        }
    }


    form.mmUnit.addEventListener('change', function() {
        'use strict';
        form.widthInput.value *= 25.4;
        form.heightInput.value *= 25.4;
    });

    form.inUnit.addEventListener('change', function() {
        'use strict';
        form.widthInput.value /= 25.4;
        form.heightInput.value /= 25.4;
    });

    if (form.unitOptions[1].checked) {
        // Millimeters
        form.widthInput.value *= 25.4;
        form.heightInput.value *= 25.4;
    }

    form.latInput.addEventListener('change', function() {
        'use strict';
        map.setCenter([form.lonInput.value, form.latInput.value]);
    });

    form.lonInput.addEventListener('change', function() {
        'use strict';
        map.setCenter([form.lonInput.value, form.latInput.value]);
    });

    form.zoomInput.addEventListener('change', function(e) {
        'use strict';
        map.setZoom(e.target.value);
    });




    //
    // Error modal
    //

    var origBodyPaddingRight;

    function openErrorModal(msg) {
        'use strict';
        var modal = document.getElementById('errorModal');
        document.getElementById('modal-error-text').innerHTML = msg;
        modal.style.display = 'block';
        document.body.classList.add('modal-open');
        document.getElementById('modalBackdrop').style.height =
            modal.scrollHeight + 'px';
        document.getElementById('modalBackdrop').style.display = 'block';

        if (document.body.scrollHeight > document.documentElement.clientHeight) {
            origBodyPaddingRight = document.body.style.paddingRight;
            var padding = parseInt((document.body.style.paddingRight || 0), 10);
            document.body.style.paddingRight = padding + measureScrollbar() + 'px';
        }
    }

    function closeErrorModal() {
        'use strict';
        document.getElementById('errorModal').style.display = 'none';
        document.getElementById('modalBackdrop').style.display = 'none';
        document.body.classList.remove('modal-open');
        document.body.style.paddingRight = origBodyPaddingRight;
    }

    function measureScrollbar() {
        'use strict';
        var scrollDiv = document.createElement('div');
        scrollDiv.className = 'modal-scrollbar-measure';
        document.body.appendChild(scrollDiv);
        var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
        document.body.removeChild(scrollDiv);
        return scrollbarWidth;
    }


    //
    // Helper functions
    //

    function toPixels(length) {
        'use strict';
        var unit = form.unitOptions[0].checked ? 'in' : 'mm';
        var conversionFactor = 96;
        if (unit == 'mm') {
            conversionFactor /= 25.4;
        }

        return conversionFactor * length + 'px';
    }

    //
    // High-res map rendering
    //

    document.getElementById('generate-btn').addEventListener('click', generateMap);

    function generateMap() {
        'use strict';

        if (isError()) {
            openErrorModal('The current configuration is invalid! Please ' +
                'correct the errors and try again.');
            return;
        }

        //document.getElementById('spinner').style.display = 'inline-block';
        document.getElementById('generate-btn').classList.add('disabled');

        var width = Number(form.widthInput.value);
        var height = Number(form.heightInput.value);

        var dpi = Number(form.dpiInput.value);

        var format = 'png';

        var unit = form.unitOptions[0].checked ? 'in' : 'mm';

        var style = form.styleSelect.value;
        if (style.indexOf('maptiler') >= 0)
            style += '?key=' + mapTilerAccessToken;
        // style = "mapbox://styles/mapbox/streets-v11";

        var zoom = map.getZoom();
        var center = map.getCenter();
        var bearing = map.getBearing();
        var pitch = map.getPitch();

        createPrintMap(width, height, dpi, format, unit, zoom, center,
            bearing, style, pitch);
    }

    function createPrintMap(width, height, dpi, format, unit, zoom, center,
        bearing, style, pitch) {
        'use strict';

        // Calculate pixel ratio
        var actualPixelRatio = window.devicePixelRatio;
        Object.defineProperty(window, 'devicePixelRatio', {
            get: function() { return dpi / 96 }
        });

        // Create map container
        var hidden = document.createElement('div');
        // hidden.className = 'hidden-map';
        hidden.id = 'grab-map';
        document.body.appendChild(hidden);
        var container = document.createElement('div');
        container.id = 'grab';
        // container.setAttribute('data-html2canvas-ignore','true');
        container.style.width = toPixels(width);
        container.style.height = toPixels(height);
        let footerDiv = document.createElement('div');
        footerDiv.classList.add('mapboxgl-ctrl-bottom-left')
        footerDiv.classList.add('customName_bottom_blur')
        footerDiv.classList.add('pt-3')
        footerDiv.style.textAlign = 'center';
        footerDiv.innerHTML = document.getElementById('mainFrame').innerHTML;
        container.appendChild(footerDiv);
        hidden.appendChild(container);
        // console.log(document.getElementById('mainFrame').innerHTML)
        // console.log(container)

        // Render map
        var renderMap = new mapboxgl.Map({
            container: container,
            center: center,
            zoom: zoom,
            style: style,
            bearing: bearing,
            pitch: pitch,
            interactive: false,
            preserveDrawingBuffer: true,
            fadeDuration: 0,
            attributionControl: false,
        });

        // console.log(renderMap)

        // console.log(document.getElementById('grab-map'))



        // var img = new Image();
        // var mapCanvas = document.getElementById('grab');
        // img.src = mapCanvas.toDataURL();
        // document.getElementById('test').appendChild(img);
        // document.getElementsByClassName('mapboxgl-canvas')[1].setAttribute('data-html2canvas-ignore','false');
        // console.log(document.getElementsByClassName('mapboxgl-canvas')[1])

        html2canvas(document.getElementById('grab'), { removeContainer: false, allowTaint: true, useCORS: false }).then((canvas) => {
            // var anchorTag = document.createElement("a");
            // document.body.appendChild(anchorTag);
            // anchorTag.download = "Picture.png";
            // anchorTag.href = canvas.toDataURL();
            // anchorTag.target = '_blank';
            // anchorTag.click();
            canvas.toBlob(function(blob) {
                var newImg = document.createElement('img'),
                    url = URL.createObjectURL(blob);
                tempblob = blob;
                //blob
                newImg.id = 'temp';
                newImg.style.display = 'none';
                newImg.onload = function() {
                    // no longer need to read the blob so it's revoked
                    URL.revokeObjectURL(url);
                };

                newImg.src = url;
                document.body.appendChild(newImg);

                renderMap.once('load', function() {
                    if (format == 'png') {
                        // let c = renderMap.getCanvas();
                        // console.log(c)
                        // var ctx = c.getContext("webgl");
                        // var img = document.getElementById("temp");
                        // console.log(img)
                        // // console.log(img)
                        //
                        //     console.log('in')
                        //         console.log(ctx)
                        //     ctx.drawImage(img, 20, 20);
                        //
                        //
                        // setTimeout( () => {
                        //     console.log('tt')
                        renderMap.getCanvas().toBlob(function(blob) {
                            var reader = new FileReader();
                            reader.readAsDataURL(blob);
                            reader.onloadend = function() {
                                var base64data = reader.result;
                                var tempImageSize = document.getElementById('temp');
                                var tempWidth = tempImageSize.clientWidth;
                                var tempHeight = tempImageSize.clientHeight;
                                let pp = document.getElementById('pp');
                                pp.src = base64data;

                                // var link = document.createElement('a');
                                // link.download = 'filename.png';
                                // link.href =document.getElementsByClassName('mapboxgl-canvas')[1].toDataURL()
                                // link.click();

                                // var c= document.getElementById("myCanvas");
                                // var ctx= c.getContext("2d");
                                //
                                //     ctx.drawImage(document.getElementById('pp'), 0, 0, 40, 40);
                                //
                                //         ctx.drawImage( document.getElementById('temp'), 5, 5, 5, 5);
                                //         var p = c.toDataURL("image/png");
                                //         document.getElementById('final').src = p;





                                var to = new FileReader();
                                to.readAsDataURL(tempblob);
                                to.onloadend = function() {
                                    var base64String = to.result;
                                    mergeImages([
                                        { src: base64data, x: 0, y: 0, opacity: 0.7 },
                                        { src: base64String, x: 400, y: 1000, }
                                    ]).then(b64 => {
                                        let finalImage = document.getElementById('final');
                                        finalImage.src = b64;
                                        finalImage.style.height = tempHeight + 'px';
                                        finalImage.style.width = tempHeight + 'px';

                                        var image = document.getElementById('final');
                                        var saveImg = document.createElement('a');
                                        saveImg.href = image.src
                                        saveImg.download = "map.png";
                                        saveImg.click();
                                    });
                                }


                                // const img = document.querySelector('#temp');
                                // const dataUrl = getDataUrl(img);

                                function getDataUrl(img) {
                                    // Create canvas
                                    // const canvas = document.createElement('canvas');
                                    // const ctx = canvas.getContext('2d');
                                    // // Set width and height
                                    // canvas.height = img.naturalHeight;
                                    // canvas.width = img.naturalWidth;
                                    //
                                    //
                                    // // Draw the image
                                    // ctx.drawImage(img, 0, 0);
                                    // let base64FooterString =  canvas.toDataURL('image/jpeg');



                                }
                                // Select the image


                                // console.log(document.getElementById('temp'))





                                // let resEle = document.getElementById("myCanvas");
                                // var context = resEle.getContext("2d");
                                // console.log(document.getElementById('pp'))
                                //     resEle.width = imgEle1.width;
                                //     resEle.height = imgEle1.height;
                                //     context.globalAlpha = 1.0;
                                //     context.drawImage(imgEle1, 0, 0);
                                //     context.globalAlpha = 0.5;
                                //     context.drawImage(imgEle2, 0, 0);
                                console.log('done')

                            }

                            // saveAs(blob, 'map.png');

                            // mergeImages([blob, blob])
                            //     .then(b64 => document.querySelector('img').src = b64);
                            // console.log('test')
                            //     mergeImages([
                            //         { src: blob, x: 0, y: 0 },
                            //         { src: blob, x: 32, y: 0 },
                            //     ]).then(b64 =>
                            //     console.log(b64)
                            //     );

                            //
                            // var c=document.getElementById("myCanvas");
                            // var ctx=c.getContext("2d");
                            // console.log('man?')
                            // const blobToImage = (blob) => {
                            //     return new Promise(resolve => {
                            //         console.log('inside')
                            //         const url = URL.createObjectURL(blob)
                            //         let img = new Image()
                            //         img.onload = () => {
                            //             URL.revokeObjectURL(url)
                            //             resolve(img)
                            //             console.log('inside 2')
                            //
                            //         }
                            //         var imageObj1 = new Image();
                            //         imageObj1.src = url;
                            //         imageObj1.onload = function() {
                            //             ctx.drawImage(imageObj1, 0, 0, 328, 526);
                            //             // imageObj2.src = "2.png";
                            //             // imageObj2.onload = function() {
                            //             //     ctx.drawImage(imageObj2, 15, 85, 300, 300);
                            //             var img = c.toDataURL("image/png");
                            //             document.write('<img src="' + img + '" width="328" height="526"/>');
                            //             console.log('created')
                            //             // }
                            //         };
                            //     })
                            // }

                            // var imageObj1 = new Image();
                            // var imageObj2 = new Image();
                            // imageObj1.src = blob;
                            // imageObj1.onload = function() {
                            //     ctx.drawImage(imageObj1, 0, 0, 328, 526);
                            //     // imageObj2.src = "2.png";
                            //     // imageObj2.onload = function() {
                            //     //     ctx.drawImage(imageObj2, 15, 85, 300, 300);
                            //         var img = c.toDataURL("image/png");
                            //         document.write('<img src="' + img + '" width="328" height="526"/>');
                            //         console.log('created')
                            //     // }
                            // };


                        });
                        // },3000)


                    } else {
                        var pdf = new jsPDF({
                            orientation: width > height ? 'l' : 'p',
                            unit: unit,
                            format: [width, height],
                            compress: true
                        });

                        pdf.addImage(renderMap.getCanvas().toDataURL('image/png'),
                            'png', 0, 0, width, height, null, 'FAST');

                        var title = map.getStyle().name,
                            subject = "center: [" + form.lonInput.value + ", " + form.latInput.value + ", " + form.zoomInput.value + "]",
                            attribution = '(c) ' +
                            (form.styleSelect.value.indexOf('mapbox') >= 0 ? 'Mapbox' : 'OpenMapTiles') +
                            ', (c) OpenStreetMap';

                        pdf.setProperties({
                            title: title,
                            subject: subject,
                            creator: 'Print Maps',
                            author: attribution
                        })

                        pdf.save('map.pdf');
                    }

                    renderMap.remove();
                    hidden.parentNode.removeChild(hidden);
                    Object.defineProperty(window, 'devicePixelRatio', {
                        get: function() { return actualPixelRatio }
                    });
                    // document.getElementById('spinner').style.display = 'none';
                    document.getElementById('generate-btn').classList.remove('disabled');
                });
                //
                //                 var c = document.getElementById("myCanvas");
                //                 var ctx = c.getContext("2d");
                //                 var img = document.getElementById("temp");
                //                 // console.log(img)
                //                 img.onload = function() {
                //                     ctx.drawImage(img, 5, 5);
                //                 };
                //
                //
                //                 map.on('load', () => {
                //                     map.addSource('canvas-source', {
                //                         type: 'canvas',
                //                         canvas: 'canvasID',
                //                         coordinates: [
                //                             [91.4461, 21.5006],
                //                             [100.3541, 21.5006],
                //                             [100.3541, 13.9706],
                //                             [91.4461, 13.9706]
                //                         ],
                // // Set to true if the canvas source is animated. If the canvas is static, animate should be set to false to improve performance.
                //                         animate: true
                //                     });
                //
                //                     map.addLayer({
                //                         id: 'canvas-layer',
                //                         type: 'raster',
                //                         source: 'canvas-source'
                //                     });
                //                 });

                // var c = document.getElementsByClassName('mapboxgl-canvas')[1];
                // var ctx= c.getContext("2d");
                // console.log(ctx)
                // var imageObj1 = new Image();
                // var imageObj2 = new Image();
                // imageObj1.src = document.getElementById('temp').getAttribute('src');
                // imageObj1.onload = function() {
                //     console.log(imageObj1)
                //     ctx.drawImage(imageObj1, 0, 0, 20, 20);
                //     // imageObj2.src = "2.png";
                //     // imageObj2.onload = function() {
                //     //     ctx.drawImage(imageObj2, 15, 85, 300, 300);
                //     //     var img = c.toDataURL("image/png");
                //     //     document.write('<img src="' + img + '" width="328" height="526"/>');
                //     // }
                // };
            });


        });

        // html2canvas(document.getElementById('grab'), {
        //     onrendered: function(canvas) {
        //         var anchorTag = document.createElement("a");
        //         document.body.appendChild(anchorTag);
        //         anchorTag.download = "Picture.png";
        //         anchorTag.href = canvas.toDataURL();
        //         anchorTag.target = '_blank';
        //         anchorTag.click();
        //
        //
        //     }
        // });
        // document.getElementById('test').innerHTML = renderMap;
        // return;
        /*
        if (format == 'png') {
            renderMap.getCanvas().toBlob(function (blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function () {
                    var base64data = reader.result;
                    //var prj_content = 'PROJCS["WGS 84 / Pseudo-Mercator",GEOGCS["GCS_WGS_1984",DATUM["D_WGS_1984",SPHEROID["WGS_1984",6378137,298.257223563]],PRIMEM["Greenwich",0],UNIT["Degree",0.017453292519943295]],PROJECTION["Mercator"],PARAMETER["central_meridian",0],PARAMETER["scale_factor",1],PARAMETER["false_easting",0],PARAMETER["false_northing",0],UNIT["Meter",1]]';
                    var prj_content = 'GEOGCS["GCS_WGS_1984",DATUM["D_WGS_1984",SPHEROID["WGS_1984",6378137,298.257223563]],PRIMEM["Greenwich",0],UNIT["Degree",0.017453292519943295]]';

                    //convertBase64ToFile(base64data, 'map.png');

                    download(base64data, "print."+format, "image/"+format);
                        //download(prj_content,'print.prj','text/plain');
                        //CalcWorldFile('print.js');
                }
                //saveAs(blob, fileName +'.png');
            });
        }
        */

    }

    function download(data, strFileName, strMimeType) {

        var self = window, // this script is only for browsers anyway...
            defaultMime = "application/octet-stream", // this default mime also triggers iframe downloads
            mimeType = strMimeType || defaultMime,
            payload = data,
            url = !strFileName && !strMimeType && payload,
            anchor = document.createElement("a"),
            toString = function(a) { return String(a); },
            myBlob = (self.Blob || self.MozBlob || self.WebKitBlob || toString),
            fileName = strFileName || "download",
            blob,
            reader;
        myBlob = myBlob.call ? myBlob.bind(self) : Blob;

        if (String(this) === "true") { //reverse arguments, allowing download.bind(true, "text/xml", "export.xml") to act as a callback
            payload = [payload, mimeType];
            mimeType = payload[0];
            payload = payload[1];
        }


        if (url && url.length < 2048) { // if no filename and no mime, assume a url was passed as the only argument
            fileName = url.split("/").pop().split("?")[0];
            anchor.href = url; // assign href prop to temp anchor
            if (anchor.href.indexOf(url) !== -1) { // if the browser determines that it's a potentially valid url path:
                var ajax = new XMLHttpRequest();
                ajax.open("GET", url, true);
                ajax.responseType = 'blob';
                ajax.onload = function(e) {
                    download(e.target.response, fileName, defaultMime);
                };
                setTimeout(function() { ajax.send(); }, 0); // allows setting custom ajax headers using the return:
                return ajax;
            } // end if valid url?
        } // end if url?


        //go ahead and download dataURLs right away
        if (/^data\:[\w+\-]+\/[\w+\-]+[,;]/.test(payload)) {

            if (payload.length > (1024 * 1024 * 1.999) && myBlob !== toString) {
                payload = dataUrlToBlob(payload);
                mimeType = payload.type || defaultMime;
            } else {
                return navigator.msSaveBlob ? // IE10 can't do a[download], only Blobs:
                    navigator.msSaveBlob(dataUrlToBlob(payload), fileName) :
                    saver(payload); // everyone else can save dataURLs un-processed
            }

        } //end if dataURL passed?

        blob = payload instanceof myBlob ?
            payload :
            new myBlob([payload], { type: mimeType });


        function dataUrlToBlob(strUrl) {
            var parts = strUrl.split(/[:;,]/),
                type = parts[1],
                decoder = parts[2] == "base64" ? atob : decodeURIComponent,
                binData = decoder(parts.pop()),
                mx = binData.length,
                i = 0,
                uiArr = new Uint8Array(mx);

            for (i; i < mx; ++i) uiArr[i] = binData.charCodeAt(i);

            return new myBlob([uiArr], { type: type });
        }

        function saver(url, winMode) {

            if ('download' in anchor) { //html5 A[download]
                anchor.href = url;
                anchor.setAttribute("download", fileName);
                anchor.className = "download-js-link";
                anchor.innerHTML = "downloading...";
                anchor.style.display = "none";
                document.body.appendChild(anchor);
                setTimeout(function() {
                    anchor.click();
                    document.body.removeChild(anchor);
                    if (winMode === true) { setTimeout(function() { self.URL.revokeObjectURL(anchor.href); }, 250); }
                }, 66);
                return true;
            }

            // handle non-a[download] safari as best we can:
            if (/(Version)\/(\d+)\.(\d+)(?:\.(\d+))?.*Safari\//.test(navigator.userAgent)) {
                url = url.replace(/^data:([\w\/\-\+]+)/, defaultMime);
                if (!window.open(url)) { // popup blocked, offer direct download:
                    if (confirm("Displaying New Document\n\nUse Save As... to download, then click back to return to this page.")) { location.href = url; }
                }
                return true;
            }

            //do iframe dataURL download (old ch+FF):
            var f = document.createElement("iframe");
            document.body.appendChild(f);

            if (!winMode) { // force a mime that will download:
                url = "data:" + url.replace(/^data:([\w\/\-\+]+)/, defaultMime);
            }
            f.src = url;
            setTimeout(function() { document.body.removeChild(f); }, 333);

        } //end saver




        if (navigator.msSaveBlob) { // IE10+ : (has Blob, but not a[download] or URL)
            return navigator.msSaveBlob(blob, fileName);
        }

        if (self.URL) { // simple fast and modern way using Blob and URL:
            saver(self.URL.createObjectURL(blob), true);
        } else {
            // handle non-Blob()+non-URL browsers:
            if (typeof blob === "string" || blob.constructor === toString) {
                try {
                    return saver("data:" + mimeType + ";base64," + self.btoa(blob));
                } catch (y) {
                    return saver("data:" + mimeType + "," + encodeURIComponent(blob));
                }
            }

            // Blob but not URL support:
            reader = new FileReader();
            reader.onload = function(e) {
                saver(this.result);
            };
            reader.readAsDataURL(blob);
        }
        return true;
    }

    function convertBase64ToFile(base64String, fileName) {
        let arr = base64String.split(',');
        let mime = arr[0].match(/:(.*?);/)[1];
        let bstr = atob(arr[1]);
        let n = bstr.length;
        let uint8Array = new Uint8Array(n);
        while (n--) {
            uint8Array[n] = bstr.charCodeAt(n);
        }
        let file = new File([uint8Array], fileName, { type: mime });
        downloadFile(fileName, file);
        downloadFile('myMap.png', base64String);
    }

    function downloadFile(filename, text) {
        var element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
        element.setAttribute('download', filename);

        element.style.display = 'none';
        document.body.appendChild(element);

        element.click();

        document.body.removeChild(element);
    }




} catch (error) {
    console.log(error);
    var mapContainer = document.getElementById('map');
    mapContainer.parentNode.removeChild(mapContainer);
    document.getElementById('config-fields').setAttribute('disabled', 'yes');
    // openErrorModal('This site requires WebGL, but your browser doesn\'t seem' +
    // ' to support it: ' + error.message);
}