/*
 * Print Maps - High-resolution maps in the browser, for printing
 * Copyright (c) 2015-2020 Matthew Petroff
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
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

var form = document.getElementById('config');

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
///////


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

var map;

try {
    var style = form.styleSelect.value;
    if (style.indexOf('maptiler') >= 0)
        style += '?key=' + mapTilerAccessToken;
    map = new mapboxgl.Map({
        accessToken: Token,
        container: 'map',
        center: [0, 0],
        zoom: 0.5,
        pitch: 0,
        preserveDrawingBuffer: true,
        style: style
    });
    map.addControl(
        new MapboxGeocoder({
            accessToken: Token,
            mapboxgl: mapboxgl
        }));
    map.addControl(new mapboxgl.NavigationControl());

    map.on('moveend', updateLocationInputs).on('zoomend', updateLocationInputs);
    updateLocationInputs();
} catch (e) {
    var mapContainer = document.getElementById('map');
    mapContainer.parentNode.removeChild(mapContainer);
    document.getElementById('config-fields').setAttribute('disabled', 'yes');
    openErrorModal('This site requires WebGL, but your browser doesn\'t seem' +
        ' to support it: ' + e.message);
}

//
// Geolocation
//

if ('geolocation' in navigator) {
    navigator.geolocation.getCurrentPosition(function(position) {
        'use strict';
        map.flyTo({
            center: [position.coords.longitude,
                position.coords.latitude
            ],
            zoom: 10
        });
    });
}

//
// Errors
//

var maxSize;
if (map) {
    var canvas = map.getCanvas();
    var gl = canvas.getContext('experimental-webgl');
    maxSize = gl.getParameter(gl.MAX_RENDERBUFFER_SIZE);
}

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

form.widthInput.addEventListener('change', changeWidth(e));

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

form.heightInput.addEventListener('change', changeHeight(e));

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
                                    console.log('downloaed')
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